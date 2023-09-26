#include <pthread.h>
#include <semaphore.h>
#include <stdio.h>

int count = 1;
int readerCount = 0;

sem_t writee;
pthread_mutex_t mutex;

void *writer(void *writerNo);
void *reader(void *readerNo);


int main(){
  
    pthread_t read[5],write[2];
    pthread_mutex_init(&mutex, NULL);
    sem_init(&writee,0,1);

    int arr[5] = {1,2,3,4,5};

    for(int i = 0; i < 2; i++){
        pthread_create(&write[i], NULL, (void *)writer, (void *)&arr[i]);
    }

    for(int i = 0; i < 5; i++){
        pthread_create(&read[i], NULL, (void *)reader, (void *)&arr[i]);
    }

    for(int i = 0; i < 5; i++){
        pthread_join(read[i], NULL);
    }

    for(int i = 0; i < 2; i++){
        pthread_join(write[i], NULL);
    }

    pthread_mutex_destroy(&mutex);
    sem_destroy(&writee);

    return 0;

}

void *writer(void *writerNo){
    sem_wait(&writee);
    printf("Writer %d is writing in the file\n",(*((int *)writerNo)));
    sem_post(&writee);

}
void *reader(void *readerNo){
    // Reader acquire the lock before modifying readerCount
    pthread_mutex_lock(&mutex);
    readerCount++;

    //If we founf the first reader we will block the writer
    //So as to avoid teh situation if data inconsistency
    if(readerCount == 1){
        sem_wait(&writee);
    }

    pthread_mutex_unlock(&mutex);
    printf("Reader %d: read count as %d\n",*((int *)readerNo),readerCount);

    //When a reader leaves reduce the reader count
    pthread_mutex_lock(&mutex);
    readerCount--;

    //If we come to teh end of reader list we will now wake uo the writer
    if(readerCount == 0) {
        sem_post(&writee);
    }
    pthread_mutex_unlock(&mutex);
}