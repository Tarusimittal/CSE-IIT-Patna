#include <stdio.h>
#include <stdlib.h>
#include <pthread.h>
#include <unistd.h>

typedef void* address_t;
void* helloworld(void * number);

int main(int argc, char* argv[]){
	
	pthread_t threads[10];    //The number of thread that we want to make
	int num[10];			//Used later to save the current thread number
	
	int i,report;            //Declaring the variables that are used later on

	for (i = 0; i < 10; i++){     // limit i<the number of threads we want to make
		num[i]=i;
	
		//When the thread will be created it will go the helloworld function as well
		report = pthread_create(&threads[i], NULL, helloworld, (address_t)&num[i]);
		
		//If by some reasin there is any other exit code then the thread is not created properly 
		//We will print its staus as cancelled
		if (report != 0) {  
			printf("i = %d, status = Cancelled.\n",i);
			exit(1);
		}
		
		//Othewise we will create the thread and print its status as well 
		printf("i = %d, status = Thread %d.\n",i, i);
	}

	pthread_exit(NULL);
	return 0;
}

void* helloworld(void * number){
	int thread = *(int*) number;
	//It will consider the thread and extract its thread no
	printf("Thread %d: Hello world !\n", thread);
	pthread_exit(NULL);
}