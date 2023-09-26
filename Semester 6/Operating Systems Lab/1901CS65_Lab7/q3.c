#include <pthread.h>
#include <stdio.h>
#include <unistd.h>
#include <stdbool.h>

int noOfSlices=0;
bool has_been_ordered;
pthread_cond_t orderPlaced;
pthread_cond_t deliveryMade;
pthread_mutex_t mutex;

void *studentUpNow(void *studentNumber);
void *deliveryGuy();

int main() {

    pthread_t delivery;
    pthread_t student[8];
    pthread_mutex_init(&mutex, NULL);
    pthread_cond_init(&orderPlaced, NULL);
    pthread_cond_init(&deliveryMade, NULL);

    int arr[8] = {1,2,3,4,5,6,7,8};

    pthread_create(&delivery, NULL, (void *)deliveryGuy, NULL);

    for(int i = 0; i < 8; i++) {
        pthread_create(&student[i], NULL, (void *)studentUpNow, (void *)&arr[i]);
    }

    pthread_join(delivery, NULL);

    for(int i = 0; i < 8; i++) {
        pthread_join(student[i], NULL);
    }

    pthread_cond_destroy(&deliveryMade);
    pthread_cond_destroy(&orderPlaced);
    pthread_mutex_destroy(&mutex);

    return 0;
}

void *studentUpNow(void *studentNumber){
  while(true){
    pthread_mutex_lock(&mutex);
    //If slices are greatee than 5 it means
    //more stydents can come and eat
    if (noOfSlices > 0) {
      noOfSlices--;
    }
    else{
      //otherwise the last student will orderPlaced a new pizza
      if(!has_been_ordered){
        pthread_cond_signal(&orderPlaced);
        has_been_ordered = true;
      }
      while (noOfSlices <= 0) {
        pthread_cond_wait(&deliveryMade, &mutex);
      }
      noOfSlices--;
    }

    printf("Student no %d is eating and studying\n", *((int *)studentNumber));
    printf("Only %d / 5 remaining\n", noOfSlices);
    //to avoid clashes
    sleep(1);
    pthread_mutex_unlock(&mutex);
    sleep(2);
  }
}

void *deliveryGuy(){
  // If teh guy ius delivering then we go in the loop
  while(true) {
    pthread_mutex_lock(&mutex);
    pthread_cond_wait(&orderPlaced, &mutex);
    printf("|---------Hey! Pizza Delivery--------|\n");
    //We close the loop and define no of slid=ces to be 5 as per teh question
    noOfSlices = 5;
    has_been_ordered = false;
    pthread_cond_broadcast(&deliveryMade);
    pthread_mutex_unlock(&mutex);
  }
}