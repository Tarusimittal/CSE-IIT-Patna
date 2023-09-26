#include <stdio.h>
#include <unistd.h>
#include <stdlib.h>
#include <pthread.h>

pthread_mutex_t lock;
pthread_cond_t condi;
int req = 0;
int amt = 500;

void* hack(void* arg);
void* borrow(void* arg);
void* deposit(void* arg);


int main(){
    pthread_mutex_init(&lock, NULL);
    pthread_t borrower, depositor, hacker;

    pthread_create(&borrower, NULL, borrow, NULL);
    pthread_create(&depositor, NULL, deposit, NULL);
    pthread_create(&hacker, NULL, hack, NULL);

    pthread_join(hacker, NULL);
    return 0;
}

void* hack(void* arg){
    pthread_mutex_lock(&lock);
    printf("Hacked %d amount from you.\n",amt);
    pthread_mutex_unlock(&lock);
    return NULL;
}

void* borrow(void* arg){
    while(1){
        pthread_mutex_lock(&lock);
        printf("Enter amount: ");
        scanf("%d",&req);
        if(req > amt)
            pthread_cond_wait(&condi, &lock);
        amt -= req;
        printf("Amount = %d, borrowed.\n", req);
        printf("Total Amount Left = %d\n",amt);
        req = 0;
        pthread_mutex_unlock(&lock);
    }
}

void* deposit(void* arg){
    while(1){
        pthread_mutex_lock(&lock);
        if(req){
            printf("Amount = %d, deposited.\n", req-amt);
            amt = req;
            printf("Total Amount Left= %d\n",amt);
            pthread_cond_signal(&condi);
        }
        pthread_mutex_unlock(&lock);
    }
}