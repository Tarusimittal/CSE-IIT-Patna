#include<sys/socket.h>
#include<arpa/inet.h>
#include<stdio.h>
#include<unistd.h>
#include<fcntl.h>
#include<sys/types.h>
#include<string.h>
#include<stdlib.h>

int main(){

  char filebuffer[1500];
  char nameOfFile[150];

  for(int i=0;i<=150;i++){
    nameOfFile[i]='\0';
  }

  struct sockaddr_in serverAddress,clientAddress;

  int socketVar = socket(AF_INET, SOCK_DGRAM, 0);

  if(socketVar!=-1){
    printf("Socket was created successfully in  the server\n");
    }
  else{
    printf(" Socket could not be created in the server\n");
    exit(0);
    }

  bzero(&serverAddress, sizeof(serverAddress));

  serverAddress.sin_family = AF_INET;
  serverAddress.sin_addr.s_addr = INADDR_ANY;
  serverAddress.sin_port = htons(8000);
  memset(&(serverAddress.sin_zero),'\0',8);

  if(bind(socketVar, (struct sockaddr *)&serverAddress, sizeof(serverAddress)) != 0 ){
    printf("Cant bind\n");
  }
  else{
    printf("Binding done !\n");
  }

  int len=sizeof(clientAddress);

  while(1){
  	char num;
  	recvfrom(socketVar,&num,sizeof(num),0,(struct sockaddr *)&clientAddress, &len);

	  recvfrom(socketVar,nameOfFile,1024,0,(struct sockaddr *)&clientAddress, &len);

	  printf("NAME OF TEXT FILE RECEIVED : %s\n",nameOfFile);
 	  printf("Contents in the received text file : \n");
 	  recvfrom(socketVar,filebuffer,1024,0,(struct sockaddr *)&clientAddress, &len);

 	  printf("%s\n",filebuffer);
    
	  memset(nameOfFile, '\0', sizeof(nameOfFile));
  }
  return(0);
}