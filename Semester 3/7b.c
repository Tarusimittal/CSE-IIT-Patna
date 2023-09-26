//Tarusi Mittal
//1901CS65

#include<stdio.h>
#include<stdlib.h>
#define inp(q) scanf("%d",&q)
#define oup(q) printf("%d",q)


int black[2501]={};
int grey[2501]={};
int final=0;

void solution(int n,int x, int arr[],int adjacency[][150]);

int main(){
    //inputing all the values
    int n;
    printf("Input the no of nodes: \n");
    inp(n); 
    //taking input of teh ements of array
    int arr[n+1];
    printf("Enter elements of array: \n");
    for(int i=1; i<n+1; i++){
       inp(arr[i]);
    }
    
    //inputing the nodes which have edges between them
    int adjacency[150][150];
    printf("Enter the nodes pairwise which consitute the edges: \n");
    for(int i=0; i<n-1; i++){
        int j;
        inp(j);
        int k;
        inp(k);
        //filling up the adjacency matrix at the same point while taking the input
        adjacency[j][k]=1, adjacency[k][j]=1; 
    }
    
    //the function uses the concept of dfs
    //we will start dfs from first node
    solution(n,1,arr,adjacency);                
    
    //special nodes printing
    oup(final);   
    return 0;
}

void solution(int n,int x, int arr[],int adjacency[][150]){
    grey[x]=1;
    
    //Checking if a node with this value has occurred before or not. 
    //black array tells us if we have travesred that particular node or not
    //if not visited we turn it black and the final value increases by one
    if(black[arr[x]]==0){
        final++;
        black[arr[x]]=1;
    }
    else{
       return;
    }
    
    //recusively calling the dfs function if the conditions fulfilled
    //the value of adjacency matrix should be equal to one
    //value of the once traversed call should be zero
    for(int i=1; i<n+1; i++){
        if(adjacency[i][x]!=0){
            if(grey[i]==0){
            solution(n,i,arr,adjacency);
            }
        }
    }
    
    //back to step 1 of bactracting by making the black value =0;
    black[arr[x]]=0;                     
}