//Tarusi Mittal
//1901CS65

#include<stdio.h>
#include<stdlib.h>
#define inp(q) scanf("%d",&q)
#define oup(q) printf("%d",q)

//gloabally declaring the value of total paths=0 initially
int finalPaths=0;
//globally declaring the value of visited cells as 0 initially
int grey[21][21]={};

//list of functions unsigned//both the functions use the concept of dfs
void nOfWays(int n,int arr[][21], int x,int y);
void printPath(int n, int arr[][21],int x,int y,int valuex[], int valuey[], int tempCnt);

//main function
int main(){
    //no of testcases
    int T;
    inp(T);         
    for(int P=0;P<T;P++){
        finalPaths=0;
        int n;
        printf("Enter the no of nodes: \n");
        inp(n);
        
        //input the values in an array;
        //whether detector is present or not
        int arr[n][21];
        for(int i=0; i<n; i++){
            for(int j=0; j<n; j++)
            inp(arr[i][j]);
        }
        
        //value of 1st cell equals 1 as we start from there
        grey[0][0]=1;   
        //to calculate no of ways we start from first cell
        nOfWays(n,arr, 0, 0); 
        //checking the core condition for the first and last cell
        if(arr[0][0]||arr[n-1][n-1]){
            printf("0\n");                 
            continue;
        }
        //printing the value of total no of paths
        oup(finalPaths);
        printf("\n(\n");
       
        for(int i=0; i<n; i++){
            for(int j=0; j<n; j++){
            //to start for that partiocular i,j
            grey[i][j]=0; 
            }
        }
        
        int valuex[500]={};
        int valuey[500]={};
        int tempCnt=1;
        grey[0][0]=1;
        
        //function to print path
        printPath(n,arr, 0, 0,valuex,valuey,tempCnt);                        
        printf(")\n");                     
    }
    return 0;
}

//function to print each path
//here we use dfs to 
void printPath(int n, int arr[][21],int x,int y,int valuex[], int valuey[], int tempCnt){
    
    //printing the path using 
    if(x==n-1){
        if(y==n-1){
           printf("( ");                                   
           for(int i=0; i<tempCnt; i++){
               printf("(");
               oup(valuex[i]+1);
               printf(", ");
               oup(valuey[i]+1);
               printf(") ");
            }
        }
        printf(")\n");                              
        return;
    }
    
    //if it is the left cell
    if(y-1>=0){
        if(grey[x][y-1]==0){
            if(arr[x][y-1]==0){
               valuex[tempCnt]=x, valuey[tempCnt]=y-1;
               grey[x][y-1]=1;
               tempCnt++;
               printPath(n,arr,x, y-1,valuex,valuey,tempCnt);
               //using bactracking
               grey[x][y-1]=0, tempCnt--; 
            }
        }
    }
    
    //if it is the right cell
    if(y+1<n){ 
        if(grey[x][y+1]==0){
            if(arr[x][y+1]==0){
               valuex[tempCnt]=x, valuey[tempCnt]=y+1;
               grey[x][y+1]=1;
               tempCnt++;
               printPath(n,arr, x, y+1,valuex,valuey,tempCnt);
               //using bactracking
               grey[x][y+1]=0, tempCnt--; 
            }
        }
    }
    
    //if it is the up cell
    if(x-1>=0){ 
        if(grey[x-1][y]==0){
            if(arr[x-1][y]==0){
               valuex[tempCnt]=x-1, valuey[tempCnt]=y;
               grey[x-1][y]=1;
               tempCnt++;
               printPath(n,arr, x-1, y,valuex,valuey,tempCnt);
               //using bactracking
               grey[x-1][y]=0;
               tempCnt--; 
            }
        }
    }
    
    //if it is the down cell
    if(x+1<n){ 
        if(grey[x+1][y]==0){
            if(arr[x+1][y]==0){
               valuex[tempCnt]=x+1, valuey[tempCnt]=y;
               grey[x+1][y]=1;
               tempCnt++;
               printPath(n,arr, x+1, y,valuex,valuey,tempCnt);
               //using bactracking
               grey[x+1][y]=0;
               tempCnt--; 
            }
        }
    }
}

//to count the no of ways
void nOfWays(int n,int arr[][21], int x,int y){
    
    //finalPaths stores the value of no of ways;
    //if we reach the end then it stops for that particualr path
    if(x==n-1){
        if(y==n-1){
           finalPaths++;
           return;
        }
    }
    
    //to check the left cell of the current cell
    if(y-1>=0){
        if(arr[x][y-1]==0){
            if(grey[x][y-1]==0){
               grey[x][y-1]=1;
               nOfWays(n,arr,x, y-1);
               //using bactracking
               grey[x][y-1]=0; 
            }
        }
    }
    
    //to check the right cell of the current cell
    if(y+1<n){
        if(arr[x][y+1]==0){
            if(grey[x][y+1]==0){
               grey[x][y+1]=1;
               nOfWays(n,arr, x, y+1);
               //using bactracking
               grey[x][y+1]=0;
            }
        }
    }
    
    //to check the up cell of the current cell
    if(x-1>=0){
        if(arr[x-1][y]==0){
            if(grey[x-1][y]==0){
               grey[x-1][y]=1;
               nOfWays(n,arr, x-1, y);
               //using bactracking
               grey[x-1][y]=0;   
            }
        }
    }
    
    //to check the down cell of the current cell
    if(x+1<n){
        if(arr[x+1][y]==0){
            if(grey[x+1][y]==0){
               grey[x+1][y]=1;
               nOfWays(n,arr, x+1, y);
               //using bactracking
               grey[x+1][y]=0;
            }
        }
    }
    
    
}