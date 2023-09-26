#include <stdio.h>
#include<stdlib.h>
#include<sys/wait.h>
#include<unistd.h>

int main(int argc, char** argv){

  //The number of children are half the no of arguments
  //Since each children has two assosiated arguments
  int noOfChildren = argc/2;
  printf("There are a total of %d children.\n", noOfChildren);

  int arr[noOfChildren];
	pid_t PID = 1;
	int countArg = 1; //keeps track of the no of arguments

  //Now we want a loop of the kind
  //That the paremt for all the child is same
  //But the child made are noOfChildren
  //The tree for which can be made as:
  //           P
	//          / \
	//         P  C1
	//       / \
	//      P   C2
	//    / \
	//   P  C3
  //  .
  //  .
  //  ...... till we create required no og child processes

	for(int i=0;i<noOfChildren;i++){
		if(PID > 0){
      //We create a fork for the parent only every time
      //So as to ensure that parent of all is same
			PID = fork();
    }

    //If fork fails then we print an error
		if (PID < 0){
      fprintf(stderr, "ERROR: ");
    }

		char ch[100];
		sprintf(ch,"%d",i+1);

    //We get the process id of teh child process in the array
		if(PID==0){
			arr[i] = getpid();
		}

		//Via thh child process we open the child.c
    //And that file does its function
		if (PID == 0) {
			char *command[] = { "child",ch,argv[countArg],argv[countArg+1], 0 };
			execv(command[0], command);

      //If our execv command fails we exit
	    exit(127);
    }

    //We increment our argumnet count by 2
    //as for 1 child we use 2 aguments
    countArg = countArg + 2;
	}

  //for the parent process
	if(PID>0){
		for(int i=0;i<noOfChildren;i++){
      //It waits for all the child processes
      //To terminate and ensure That
      //only after that we move forward
			wait(&arr[i]);
		}
	}

	printf("All child processes terminated. Parent exits\n");

  return 0;
}
