//Tarusi Mittal
//1901CS65
//end sem

#include<stdio.h>
#include<stdlib.h>
#include<math.h>

//declaring gloabal variables
int arr[1000];
int temp[500][500];
int x=0,y=0;
int ans=0;

//this variable will store the no of teh island a particular grid belong to;
int islandNo[500][500];

//functions used 
void check(int i,int j,int n, int m);
void islands(int n,int m);
void multisource_bfs(int n,int m);

//main function
int main(){
    //taking input of all the values
    int n,m;
    scanf("%d %d",&n,&m);
    int arr[n][m];
    for(int i=0;i<n;i++){
        for(int j=0;j<m;j++){
            scanf("%d", &arr[i][j]);
            temp[i][j]=arr[i][j];
        }
    }
    
    //passing arguments is the function
    //this function calcilate the no of islands and size of islands
    islands(n,m);
    
    //passing arguments is the function
    //this function calculate the minimum water grid
    printf("Water grids to be filled to connect two closest islands: ");
    multisource_bfs(n,m);
    

    return 0;
}

//function to check if the neighbours are connected or not
void check(int i,int j,int n, int m){
    if(i<0 || i>=n || j<0 || j>=m){
        return;
    }
    else if(temp[i][j]!=1){
        return;
    }
    //if adjacent neighour is 1 we change its value to 2
    temp[i][j]=2;
    islandNo[i][j]=y;
    x++;
    check(i-1,j,n,m);
    check(i+1,j,n,m);
    check(i,j-1,n,m);
    check(i,j+1,n,m);
    return;
}

//function to count the no of islands
void islands(int n,int m){
    if(n==0 || m==0){
        return ;
    }
    int k=0;
    
    for(int i=0;i<n;i++){
        for(int j=0;j<m;j++){
            //if current island value is connected
            //we pass from that index to the the check function
            if(temp[i][j]==1){
                x=0;
                y++;
                ans++;
                check(i,j,n,m);
                int a=x;
                arr[k]=a;
                k++;
            }
        }
    }
    //printing the no of islands and size of each island;
    printf("No of islands: %d \n",ans);
    printf("Size of islands: ");

    for(int i=0;i<ans;i++){
            if(i==ans-1){
                printf("%d",arr[i]);
            }
            else{
                 printf("%d, ",arr[i]);
            }
    }
    printf("\n");

}

void multisource_bfs(int n, int m){
    int min=1000;
    if(ans<=1){
        printf("0");
    }
    else{
        //checking the distance between each pair and updating it
        for(int i=0;i<n;i++){
            for(int j=0;j<m;j++){
                if(islandNo[i][j]!=0){
                for(int a=i;a<n;a++){
                    for(int b=j;b<m;b++){
                        if( islandNo[a][b]!=0){
                            if(islandNo[i][j]!=islandNo[a][b]){
                                int dis=abs(a-i)+abs(b-j)-1;
                                if(dis<=min){
                                    min=dis;
                                }
                            }
                        }
                    }
                }
                }
                
            }
        }
        printf("%d ", min);
        
    }
    
    
}
