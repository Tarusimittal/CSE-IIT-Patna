#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <sys/types.h>
#include <sys/wait.h>

void parent_process(){
	fprintf(stderr, "I am Parent with PID:%d\n",getpid());
}
void child_process(){
		sleep(20);
		//the sleep here will make the child process wait
		// now as the parent is already executed the main program ends
		// and the child process end up being orphan processes
	fprintf(stderr, "I am Orphan!! with PID:%d\n",getpid());
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
// Now as the child processes are all part of th single parent
// when we first create the whole tree we let the child process go to sleep
// And we send the one with PID>0 to execute
// now as parent process is finished the process will end
// and the child process are stuill in sleep so they will become orphan

int main() {
	int n;
	printf("Enter the number n: ");
	scanf("%d", &n);
	fflush(stdout);

	//for the first parent process
	pid_t PID = 1;

	//this for loop will make sure that our tree as described first is genrated first
	for(int i=0;i<n;i++){
		if(PID){
			PID = fork();
		}
	}
	//parent process
	if(PID){
		parent_process();
	}
	else{
				child_process();
	}
	return 0;

}
