#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <string.h>
#include<sys/wait.h>

char p;
FILE *fPt;

void childWrite(int num);

int main(){

	char filename[] = "readFileForQ1.c";

	// We open the file by the given filename
	fPt = fopen(filename, "r");

	//We first check if the file even exsits or not
	if (fPt == NULL){
    //If does not we give the user error
		printf("File with name %s does not exsist", filename);
		return 0;
	}

	char curr; //to extract characters
	int noOfLines = 0; //store the count of no of lines

	for (curr = getc(fPt); curr != EOF; curr = getc(fPt)){
		if (curr == '\n'){
      //'/n' denotes that line is changed so whenever we encounter '/n' we increment the line no
			noOfLines++;
    }
  }

  //now sicne the last line wont end in a '/n' character we do increase
  //the no of lines by 1
  noOfLines++;

	fclose(fPt); //closes the file
	printf("The file %s has %d lines\n", filename, noOfLines);

	int id[noOfLines];
	fPt = fopen(filename, "r"); //opens the source file
	pid_t PID = 1;
	// Let P be the parent process
	for(int i=0;i<noOfLines;i++){

    //Fork not done propoerly
		if (PID < 0){
      fprintf(stderr, "ERROR: ");
    }

    //parent process
		if(PID > 0){
			PID = fork();
    }

		char arr[100];
		sprintf(arr,"%d",i+1);
		//child process
		if(PID == 0){
			childWrite(i+1);
			exit(0);
    }
    else{
      wait(0);
    }
	}

	fclose(fPt); //closes teh source file
	return 0;
}

//To write text into new files
void childWrite(int num){
  //makes a new file and write the
  //respective line no in it
  FILE * fPtr;
  char arr[100];
  sprintf(arr,"%d",num);

  char ex[]=".txt";
  strcat(arr,ex);

  fPtr = fopen(arr, "w");
  p = fgetc(fPt);
 	while (p != EOF ){
    fputc(p, fPtr);
    char curr = p;
    if(curr =='\n'){
      break;
    }
    p = fgetc(fPt);
  }
	printf("I am Child %d: and I wrote line number:%d in the file %d.txt!\n", num, num,num);
}
