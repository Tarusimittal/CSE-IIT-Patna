#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <sys/types.h>

int main(int argc, char* argv[]) {
	if (argc != 3) {
		printf("Invalid number of arguments. \n");
		return 1;
	}

	  int fd1[2]; // File to communicate with child 1: Sum
   	int fd2[2]; // File to communicate with child 1: Product

		//taking inputs as stored for command line i
    int num1;
    sscanf(argv[1], "%d", &num1);
		int num2;
    sscanf(argv[2], "%d", &num2);


    if (pipe(fd1) == -1 || pipe(fd2) == -1){
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
			// As PID>0 so this is the parent process
    	int sum, product;
    	read(fd1[0], &sum, sizeof(int)); //the sum storage will be taken from fd1
    	read(fd2[0], &product, sizeof(int)); // the product storage will be taken from fd2
    	printf("Division by Parent %d: %d\n", getpid(), product / sum);
    }
    else {
			// Here we will fork it again to create two child process
    	PID = fork();

			// If PID is negative then forking is not done properly
    	if (PID < 0){
				printf("ERROR: Fork failed.");
		    exit(3);
			}

    	// For the sum child
    	if (PID) {
    		int ansSum = num1 + num2;
    		printf("Sum by Child %d: %d\n", getpid(), ansSum);
    		write(fd1[1], &ansSum, sizeof(int));
    	}
    	// For the product Child
    	else {
    		int ansProduct = num1 * num2;
    		printf("Multiplication by Child %d: %d\n", getpid(), ansProduct);
    		write(fd2[1], &ansProduct, sizeof(int));
    	}
    }
    return 0;
}
