#include <stdio.h>
void main(int argc, char* argv[], char* envp[]) {
 char** environ;
 int i=0;
 while(environ[i]!=NULL){
  printf("%s \n", environ[i++]);
  }
}
