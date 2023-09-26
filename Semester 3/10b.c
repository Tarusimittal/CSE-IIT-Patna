//Tarusi Mittal
//1901CS65
#include<stdio.h>
#include<stdlib.h>
#include<math.h>
#define f(i,n) for(int i=1;i<=n;i++)
#define in(a) scanf("%d",&a)

//declaring global variables
int HeadNode[150];

//functions used
int bfs(int n,int source, int sink,int arr[150][150]);


int main(){
    //taking input of nodes and matrix
    int n;
    in(n); 
    int sink;
    int arr[150][150];
	f(i,n){
	    int temp=0;
	    f(j,n){
	        in(arr[i][j]);         
	        if(arr[i][j]==0){
	            //count to check for sink
	            temp++;
	        }
	    }
	    if(temp==n){ 
	        //sink has only inflow
	        sink=i;
	    }
	}
	int source;
	f(i,n){
	    int count=0;
	    f(j,n){
	        if(arr[j][i]==0)
	        count++;
	    }
	    if(count==n)                         //If entire coloumn is 0, then it is source
	    source=i;
	}
	int ans=0;
	int flowtemp;
	while(1>0){
	    flowtemp=bfs(n,source,sink,arr);                       
	    
	    if(flowtemp==0){
	       break;
	    }
	    ans=ans+flowtemp;
	    int ctr=sink;
	    
	    //while loop adjusts the capacity
	    while(ctr!=source){
	        int a=arr[ctr][HeadNode[ctr]]+flowtemp;
	        int b=arr[HeadNode[ctr]][ctr]-flowtemp;
	        arr[ctr][HeadNode[ctr]]=a;
	        arr[HeadNode[ctr]][ctr]=b;
	        ctr=HeadNode[ctr];
	    }
	}
	printf("%d", ans);                       
	return 0;
}

//bfs function to find the shortest augmenting path
int bfs(int n,int source, int sink,int arr[150][150]){
    int back=0;
    int front=0;
    int top[1000]={};
    int suceeding[1000]={};
    
    f(i,n){
    HeadNode[i]=-1;  
    }
    
    //initialysing value to variables
    top[0]=source;
    suceeding[0]=100000000;
    HeadNode[source]=-2; 
    
    while(front<=back){
        int one=top[front];
        int two=suceeding[front];                 
        front++;
        f(i,n){                              
        
        //node must be unvisited
        //the residual capacity should be zero
            if(HeadNode[i]==-1){ 
                if(arr[one][i]>=1){
            
                //updating HeadNode node
                HeadNode[i]=one;   
                
                
                //calculating minimum capacity along the path
                int flowtemp;
                if(two<arr[one][i]){
                    flowtemp=two;
                }
                else{
                    flowtemp=arr[one][i];
                }
                
                //pushing everythiung in queue
                suceeding[back+1]=flowtemp;
                top[back+1]=i; 
                back=back+1;
                
                int extra=sink; 
                if(i==extra){
                    //returning the minimum flow
                    return flowtemp; 
                }
            }
        }
        }
    }
    return 0;
}