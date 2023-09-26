#include <stdio.h>
#include <unistd.h>
#include <sys/types.h>

int main(int argc, char* argv[]) {
	//the arguments are stored in argv

	//process identification datatype
	pid_t PID = fork();

	// Task 2: Factorial
	// Parent
	if (PID) {

		//We will separate and parse the arguments
		char *task2[3];
		task2[0] = argv[argc - 2];
		task2[1] = argv[argc - 1];
		task2[2] = NULL;
		char *temp2 = argv[argc - 2];
		//they are passed to task 2
		execv(temp2, task2);
		printf("ERROR: execv() did not execute properly.");
	}

	// Task 1: Element Searching
	// Child
	else {

		//We will separate and parse the arguments
		char* task1[argc - 2];
		task1[0] = argv[1];
		for (int i = 1; i < argc - 3; i++) {
			task1[i] = argv[i + 1];
		}
		task1[argc - 3] = NULL;
		char *temp1 = argv[1];
		//argumenst passed to task 1
		execv(temp1, task1);
		printf("ERROR: execv() did not execute properly.");
	}
	return 0;
}
