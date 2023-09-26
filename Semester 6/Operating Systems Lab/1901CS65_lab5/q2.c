#include <stdio.h>
#include <pthread.h>
#include <unistd.h>
#include <string.h>
#include <stdbool.h>

bool prime[100000];  //Stores whther a number is prime or not
char c;        //used for the line characters in file
FILE *file1;   //for the read file
FILE *file2;   // for the write file
pthread_mutex_t newMutex;
pthread_t thread3; 
int line_number = 1;  //Used for storing the line number  

//Functions used in the problem 
void find_ifPrime();
void *no_of_characters(void *charnumber);
void *write_in_file(void *number);        

int main(int argc,char *argv[])
{
		if (argc != 3){
	        printf("Invalid number of arguments\n");
	        return 1;
    	}
		find_ifPrime();
		file1 = fopen(argv[1], "r");   //opens file pointer for read file
        file2 = fopen(argv[2], "w");   //opens file ppointer for write file
		c = fgetc(file1);              //To read the file

		//created two threads
		//If prime it shuould by operated by thread no 1
		//If not prime then it shuould by operated by thread no 2
        int threadone = 1, threadtwo = 2;
        pthread_t thread1, thread2;
        pthread_mutex_init(&newMutex,0);
        
        pthread_create(&thread1, 0, write_in_file, (void*)&threadone);
        pthread_create(&thread2, 0, write_in_file, (void*)&threadtwo);
        
        //threads are joined back
        pthread_join(thread1, 0);
        pthread_join(thread2, 0);
        
        fclose(file1);// CLose file pointer for read file
        fclose(file2);// CLose file pointer for write file
        
        
        pthread_mutex_destroy(&newMutex);
        return 0;
}

//This function writes the lines according to
//if the line number is prime or not
void *write_in_file(void *number){
	
	int x = *(int*)number;  //stores the thread number the process has been initiated from
	pthread_mutex_lock(&newMutex);
		
	// the while loop runs till it reaches teh end of file
    while(c!=EOF){
    	
    	//If the line is a prime numbered line
        if(prime[line_number]){
        	
        	//If the thread number is not one then it means it is prime
        	//It unloacks it 
            if(x!=1){
            	
            	pthread_mutex_unlock(&newMutex);
            	sleep(1);
               	continue;
               }
               
        	//It writes the line into new file
        	//And the 3rd thread sends it to the new function to count the characters
        	printf("The thread used for line no %d(which is prime) is : %d\n",line_number,x);
			pthread_create(&thread3, 0, no_of_characters, (void*)&line_number);
			
			//Te third thread is now joine back to the oroginal thread
			pthread_join(thread3,NULL);
           }
        else{
            
            //When it is not prime it unloacks it	
            if(x!=2){
               	pthread_mutex_unlock(&newMutex);
               	sleep(1);
               	continue;
            }
               
            //It writes the line into new file
        	//And the 3rd thread sends it to the new function to count the characters
			printf("The thread used for line no %d(which is not prime) is : %d\n",line_number,x);
			pthread_create(&thread3, 0, no_of_characters, (void*)&line_number);
			
			//Te third thread is now joine back to the oroginal thread
			pthread_join(thread3,NULL);
               	
           }
           
           //Next thread unloacked
           pthread_mutex_unlock(&newMutex);
           
           //And now locked to see whether its prime or not for the next round of while loop
           pthread_mutex_lock(&newMutex);
       }
       pthread_exit(NULL);
}

//This function finds all the primes numbers 
//Then it stores this data in our prime array
void find_ifPrime(){
    memset(prime, true, sizeof(prime));
    prime[1]=false;
    for (int num = 2; num * num <= 100005; num++){
        if (prime[num] == true){
            for (int i = num * num; i <= 100005; i += num)
                prime[i] = false;
        }
	}
}


//This function finds the no of characters
//in the current line
void *no_of_characters(void *charnumber){
	
	int line_num = *(int*)charnumber; //stores the line number
	int line_characters = 0;
	//we run the while loop until the reach the end of file
	while (c != EOF ) { 
		line_characters++;
        fputc(c, file2);
        char end = c; 
        c = fgetc(file1);
        //we stop counting the characters till we encounter a line change
        if(end =='\n'){
        	line_number++;
        	break;
        	}
    }
    
    //we print the no of charactes
    //the -1 is done becuause it counts an extra charcater of line change
    printf("Number of characters in line %d are = %d\n",line_num, line_characters-1);
    pthread_exit(NULL);
} 