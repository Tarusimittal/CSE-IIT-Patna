#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <sys/types.h>
#include <sys/wait.h>

void parent_process(){
	sleep(20); // will let the parent to go to sleep for 20 seconds and meanwhile child process will execute
	// and since chid process are complte but the parent is not they will form zombie process
	fprintf(stderr, "I am Parent with PID:%d\n",getpid());
}
void child_process(){
	fprintf(stderr, "I am Zombie!! with PID:%d\n",getpid());
}

//For this question if we see we need to generate a tree of this type
// here P is the parent
//													P
//												/  \
//											P     C1
//										/  \
//									P     C2
//								/  \
//							P    C3
// and so on
// Because when the parent process runs we want it only to genrate the further child Processes
// Now as the child processes are all part of teh single parent
// when we first create the whole tree we let the child process execute
// And we send the one with PID>0 to go to sleep
// Which makes the zombie processes.


int main() {
	int n;
	printf("Enter the number n: ");
	scanf("%d", &n);
	fflush(stdout);

	pid_t PID = 1; //For the inital parent process

	//this for loop will make sure that our tree as described first is genrated first
	for(int i=0;i<n;i++){
		if(PID){
			PID = fork();
		}
	}

	//parent process with PID>0
	if(PID){
		parent_process();
	}
	else{
				child_process();
	}
	return 0;

}
