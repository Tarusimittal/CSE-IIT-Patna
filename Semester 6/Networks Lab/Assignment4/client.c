#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <string.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <arpa/inet.h>
#include <netinet/in.h>

int main(){
	int fd;
	char nameOfFile[2000],file_buffer[2000];
	struct sockaddr_in serverAddress;

	if ( (fd = socket(AF_INET, SOCK_DGRAM, 0)) < 0 ){
		perror("Socket not created");
		exit(0);
	}

	memset(&serverAddress, 0, sizeof(serverAddress));
	bzero(&serverAddress,sizeof(serverAddress));

	serverAddress.sin_family = AF_INET;
	serverAddress.sin_port = htons(8000);
	serverAddress.sin_addr.s_addr = INADDR_ANY;
	char num='1';

	sendto(fd, &num, sizeof(num), 0,(struct sockaddr *)&serverAddress, sizeof(struct sockaddr));

	printf("Enter text file name to send : \n");
	scanf("%s",nameOfFile);
	sendto(fd, nameOfFile, strlen(nameOfFile), 0,(struct sockaddr *)&serverAddress, sizeof(struct sockaddr));

	FILE *fp;
	fp=fopen(nameOfFile,"r");

	if(fp){
		printf("Reading the file contents.\n");
		fseek(fp,0,SEEK_END);
		size_t file_size=ftell(fp);
		fseek(fp,0,SEEK_SET);
		if(fread(file_buffer,file_size,1,fp)<=0){
			printf("Unable to copy file into buffer or empty file.\n");
			exit(1);
		}
	}
	else{
		printf("File opening Failed.\n");
		exit(0);
 	}
	printf("File contents to be sent : %s\n",file_buffer);
	if(sendto(fd, file_buffer,strlen(file_buffer), 0,(struct sockaddr *)&serverAddress, sizeof(struct sockaddr))<0){
		printf("ERROR: File not sent\n");
	}
	else{
		printf("File sent successfully !\n");
	}
	fclose(fp);
}
