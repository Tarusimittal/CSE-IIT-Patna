#include <stdlib.h>
#include <stdio.h>
#include <string.h>
#include <sys/types.h>
#include <sys/wait.h>
#include <unistd.h>
#include <ctype.h>
#define LIM 1000


int main(int argc, char * argv[]) {
    if (argc != 3){
        printf("Wrong number of parameters\n");
        printf("Please enter file exectuable name followed by \n");
        return 1;
    }

    fflush(stdout);

    // We first do fork to create two process
    //the parent process will wait for the child process to complete as otherwise it will not be able to run further
    //As the child process first requires to copy the contents
    if (fork() > 0) {
        while (wait(NULL) > 0);

        //After that now we will do a fork so that we can control the next Processes
        // here the parent will wait for the child process to complete
        // since the next process cant function without the file 2 printing the contents
        fflush(stdout);
        if (fork() > 0) {
            while (wait(NULL) > 0);

            //Now to do our last process we simply delete the file
            fflush(stdout);

            //Here the child process is first deleting the file
            if (fork() == 0) {
                printf("\n");
                printf("I am a process with PID: %d to delete the file 2.\n", getpid());
                remove(argv[2]);

            }
            else {
                while (wait(NULL) > 0);
                printf("\n");
                printf("I am the parent process with PID: %d \n", getpid());
            }

        }
        // Second Child Process
        else {
          printf("\n");
          printf("I am a process with PID: %d to print the contents of the file 2.\n", getpid());
          printf("\n");
            printf("FILE 2 Contents\n");
            FILE *file2;              // Iterate over file2 to display its content
            file2 = fopen(argv[2], "r");
            char c = fgetc(file2);
            while(c != EOF) {  //It will itrate until we reach the end of file
                fputc(c, stdout); // Write the received word on the terminal
                c = fgetc(file2); // goes to fetch the next word
            }
            printf("\n");
            fclose(file2);            // CLose file pointer because otherwise there will be a memory overflow
        }
    }
    // The first child: Write contents of file1 to file2
    else {
      printf("\n");
      printf("I am a process with PID: %d to copy the contents of the file 1 into file 2.\n", getpid());
        FILE *file1;
        FILE *file2;
        file1 = fopen(argv[1], "r");
        file2 = fopen(argv[2], "w");
        char c = fgetc(file1);
        while (c != EOF) {
            fputc(c, file2);
            c = fgetc(file1);
        }
        fclose(file1);
        fclose(file2);
    }
    return 0;
}
