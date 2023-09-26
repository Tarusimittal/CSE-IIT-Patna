//Tarusi Mittal
//1901CS65
#include<stdio.h>
#include<math.h>
#include<stdlib.h>
#define f(i,n) for(int i=0;i<n;i++)
#define in(a) scanf("%d",&a)

//declaring global variables
int flow[1000][1000];
int more[1000];
int ExVertice[1000];
int height[1000];
int after;

//functions used
int push(int u, int v, int arr[100][100]);
void relabel(int u,int n, int arr[100][100]);
void dis(int u,int n,int arr[100][100]);


int main(){

    //taking input

    int n;
    int arr[100][100];
    in(n);

    f(i,n){
        f(j,n){
            in(arr[i][j]);
        }
    }

    //initialysing sink =0
    int sink=0;
    f(i,n){
        int count=0;
        f(j,n){
            if(arr[i][j]==0)
            count++;
        }
        //checking which node in sink
        //source has only inflow
        if(count==n)
            sink=i;
    }

    //initialysing source = 0
    int source=0;
    f(i,n){
        int flag=0;
        f(j,n){
            if(arr[j][i]==0)
            flag++;
        }
        //checking which node is source
        //source has only outflow
        if(flag==n)
            source=i;
    }

    height[source]=n,more[source]=100000000;

    f(i,n){
        if(arr[source][i]!=0)
        push(source, i, arr);
    }

    int before = 0;
    while (before<=after){
        int u = ExVertice[before];
        before++;
        if (u != source){
            if(u != sink){
                dis(u,n,arr);
            }
        }

    }

    int maxFlow=0;
    f(i,n){
        maxFlow += flow[i][sink];
    }


    //checking which case to answer
    while(1){
        int temp;
        in(temp);

        //printing maxflow
        if(temp==1){
            printf("%d\n", maxFlow);
        }

        //printing outflow and inflow between given nodes
        else if(temp==2){

            int vertex;
            in(vertex);

            int outflowing=0;
            int inflowing=0;

            f(i,n){
                if(arr[vertex][i]!=0)
                outflowing+=flow[vertex][i];
            }

            f(i,n){
                if(arr[i][vertex]!=0)
                inflowing+=flow[i][vertex];
            }
            printf("Outflowing : %d\nInflowing : %d\n", outflowing, inflowing);
        }

        //exiting the function in other cases
        else
        break;
    }


    return 0;
}

//if the given node has excess flow but its height is less than its connected nodes
//this functon increses the height by min height of connected node+1
void relabel(int u,int n, int arr[100][100]){
    int dist = 100000;
    f(i,n){
        if (arr[u][i] - flow[u][i] > 0){
            if(dist<=height[i]){
                dist=dist;
            }
            else{
                dist=height[i];
            }
        }

    }
    if (dist < 100000)
        height[u] = dist + 1;
}

//if given node has excess flow than any other node
//then this excess flow is given to that node
int push(int u, int v, int arr[100][100]){
    int d;
    if(more[u]<=(arr[u][v] - flow[u][v])){
        d=more[u];
    }
    else{
        d=arr[u][v] - flow[u][v];
    }

    more[u] = more[u] - d;
    more[v] = more[v] + d;
    flow[u][v] = flow[u][v] + d;
    flow[v][u] = flow[v][u] - d;


    if (d!=0){
        if(more[v]==d){
            ExVertice[after]=v;
            after++;
        }
    }


}

//checking if there is excess flow or not
//it maintains inflow=outflow
void dis(int u,int n,int arr[100][100]){
    int grey[100]={};
    while (more[u] > 0){
        if (grey[u] <= n-1){
            int v = grey[u];
            int ctr=arr[u][v]-flow[u][v];
            if (ctr >= 1 && height[u] > height[v])
                push(u, v, arr);
            else
                grey[u]=grey[u]+1;
        }
        else{
            relabel(u,n,arr);
            grey[u] = 0;
        }
    }
}