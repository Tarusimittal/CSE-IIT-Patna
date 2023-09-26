#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <sys/wait.h>
#include <sys/types.h>

int main() {
	int n;
	printf("Enter the number n: ");
	scanf("%d", &n);
	fflush(stdout);

	  int fd1[2]; // File to communicate between the two child processes
		int arr[n]; // Array to store the sequence of Lucas Number
		for(int i=0;i<n;i++){
			arr[i]=0; // Initialising all the elements to 0 first
		}


    if (pipe(fd1) == -1){
			//If the pipeline doesnot open correctly
			 printf("ERROR: Pipeline doesnot execute properly");
		    exit(0);
		}

		//process identification datatype
    pid_t PID = fork();

		//if PID is a negative number that means the forking is not done correctly
    if (PID < 0){
			printf("ERROR: Fork failed.");
	    exit(3);
		}

    // Now it will go to the parent and child processes

		//If PID>0 -> Paremt Process
		//If PID = 0 -> Child Processes
    if (PID) {
			wait(0);
    }
    else {
			// Here we will fork it again to create two child process
    	PID = fork();

			// If PID is negative then forking is not done properly
    	if (PID < 0){
				printf("ERROR: Fork failed.");
		    exit(3);
			}

    	// For the lucas generation step
    	if (PID) {
				printf("I am a process with PID: %d for generating the Lucas Sequence.\n", getpid());
				int a=2,b=1,c;
				arr[0]=2;
				arr[1]=1;
				for(int i=0;i<n;i++){
					arr[i]=a;
					c=a+b;
					a=b;
					b=c;
				}

    		write(fd1[1], arr, sizeof(int)*n); //Write into the pipeling

    	}
    	// Lucas print
    	else {
				read(fd1[0], arr, sizeof(int)*n); //Reads from the pipeline
				printf("I am a process with PID: %d for printing the Lucas Sequence.\n", getpid());
				for(int i=0;i<n;i++){
					printf("%d ",arr[i]);
				}
				printf("\n");
    	}
    }
    return 0;
}
