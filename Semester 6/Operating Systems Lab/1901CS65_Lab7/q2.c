#include <stdio.h>
#include <pthread.h>
#include <stdlib.h>
#include <semaphore.h>
#include <unistd.h>
sem_t mutex, data;

void* A(){
    sem_wait(&mutex);
    sem_wait(&data);
    printf("process A\n");
    sem_post(&mutex);
    sem_post(&data);
}

void* B(){
    sem_wait(&mutex);
    sem_wait(&data);
    printf("process B\n");
    sem_post(&data);
    sem_post(&mutex);
}

// we have used randomise function to generate random values
//So that we can make sure that our result is as much better as possible
int main(){
    sem_init(&mutex,0,1);
    sem_init(&data,0,1);
    pthread_t one, two;
    srand(time(0));
    int variTime = rand()%2;

    if(variTime==1){
      pthread_create(&one, NULL, A, NULL);
      pthread_create(&two, NULL, B, NULL);
      pthread_join(one,NULL);
      pthread_join(two,NULL);
    }
    else{
      pthread_create(&one, NULL, B, NULL);
      pthread_create(&two, NULL, A, NULL);
      pthread_join(one,NULL);
      pthread_join(two,NULL);
    }
}