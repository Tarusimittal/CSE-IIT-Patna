//Tarusi Mittal
//1901CS65
#include<stdio.h>
#include<stdlib.h>
#define in scanf
#define out printf

//declaring global variables
int n;
int m;
int match[100000], visited[100000];

//functions used
int bimatching(int graph[n][m]);
int bipartite(int graph[n][m],int u);

//main funtion
int main(){
    int i, j;
    //taking input
    in("%d %d",&n,&m);
    //initialysing a 2-D array 
    int a[n], graph[n][m];
    for(i=0;i<n;i++){
        in("%d",&a[i]);
    }
    
    for(i=0;i<n;i++){
        for(j=0;j<m;j++){
            //noting down if the number is divisible by a particular no or not
            if(a[i]%(j+1)!=0)
                graph[i][j]=0;
            else
                graph[i][j]=1;
        }
    }
    
    //outputting the answer
    int ans=bimatching(graph);
    out("%d",ans);
    return 0;
}

//to give each assignment a unique no
//first we match one assignment
//then we check is it is valid or not
int bimatching(int graph[n][m]){
    int i, k;
    int result=0;
    
    //giving value to the array
    for(i=0;i<m;i++)
            match[i]=-1;
            
            
    for(i=0;i<n;i++){
        for(k=0;k<m;k++)
            visited[k]=0;
        if(bipartite(graph,i))
            result++;
    }
    return result;
    
}

//function to check the matching is not done before
int bipartite(int graph[n][m],int u){
    int v=0;
    while(v<m){
        if(graph[u][v]-1==0 && visited[v]==0){
            visited[v]++;
            if(match[v]<0 || bipartite(graph,match[v])){
                match[v]=u;
                return 1;
            }
        }
        v++;
    }
    return 0;
}