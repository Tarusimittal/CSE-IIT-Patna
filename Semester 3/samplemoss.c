#include<stdio.h>
#include<stdlib.h>
int n, arr[27][27], ans=0, xcor[2745], ycor[2745], siz=0, visited[27][27];
void dfs(int x,int y)                     //dfs function for counting the no. of ways
{
    if(x==n-1&&y==n-1)                    //If the path leads us to terminal cell, increment ans. ans denotes the no. of possible paths
    {
        ans++;
        return;
    }
    if(x+1<n&&visited[x+1][y]==0&&arr[x+1][y]==0)        //lower cell
    {
        visited[x+1][y]=1;
        dfs(x+1, y);
        visited[x+1][y]=0;                               //backtracking
    }
    if(y-1>=0&&visited[x][y-1]==0&&arr[x][y-1]==0)       //left cell
    {
        visited[x][y-1]=1;
        dfs(x, y-1);
        visited[x][y-1]=0;                               //backtracking
    }
    if(x-1>=0&&visited[x-1][y]==0&&arr[x-1][y]==0)       //upper cel
    {
        visited[x-1][y]=1;
        dfs(x-1, y);
        visited[x-1][y]=0;                               //backtracking
    }
    if(y+1<n&&visited[x][y+1]==0&&arr[x][y+1]==0)        //right cell
    {
        visited[x][y+1]=1;
        dfs(x, y+1);
        visited[x][y+1]=0;                               //backtracking
    }
}
void dfs2(int x,int y)                                  //dfs2 function for printing each path
{
    if(x==n-1&&y==n-1)
    {
        printf("( ");                                   //Output
        for(int i=0; i<siz; i++)
            printf("(%d, %d) ", xcor[i]+1, ycor[i]+1);  //Output : x and y coordinate of each cell that led us to the terminal cell
        printf(")\n");                                  //Output
        return;
    }
    if(x+1<n&&visited[x+1][y]==0&&arr[x+1][y]==0)       //Lower cell
    {
        visited[x+1][y]=1, xcor[siz]=x+1, ycor[siz]=y, siz++;
        dfs2(x+1, y);
        visited[x+1][y]=0, siz--;                       //backtracking
    }
    if(y-1>=0&&visited[x][y-1]==0&&arr[x][y-1]==0)      //Left cell
    {
        visited[x][y-1]=1, xcor[siz]=x, ycor[siz]=y-1, siz++;
        dfs2(x, y-1);
        visited[x][y-1]=0, siz--;                       //backtracking
    }
    if(x-1>=0&&visited[x-1][y]==0&&arr[x-1][y]==0)      //Upper cell
    {
        visited[x-1][y]=1, xcor[siz]=x-1, ycor[siz]=y, siz++;
        dfs2(x-1, y);
        visited[x-1][y]=0, siz--;                       //Backtracking
    }
    if(y+1<n&&visited[x][y+1]==0&&arr[x][y+1]==0)       //Right cell
    {
        visited[x][y+1]=1, xcor[siz]=x, ycor[siz]=y+1, siz++;
        dfs2(x, y+1);
        visited[x][y+1]=0, siz--;                       //Backtracking
    }
}
int main()
{
    int t;
    scanf("%d", &t);             //Input : No. of testcases
    while(t--)
    {
        ans=0;
        scanf("%d", &n);         //Input : No. of nodes
        for(int i=0; i<n; i++)
        {
            for(int j=0; j<n; j++)
            scanf("%d", &arr[i][j]);       //Input : Presence of cell detectors in the (i,j) cell or not
        }
        for(int i=0; i<27; i++)
        {
            for(int j=0; j<27; j++)
            visited[i][j]=0;               //initializing visited[i][j]=0 for dfs
        }
        visited[0][0]=1;                   //doing visited[0][0]=1 as we are currently on the (1,1) cell
        dfs(0, 0);                         //doing dfs from the intiial cell to count the no. of possible paths
        if(arr[0][0]||arr[n-1][n-1])
        {
            printf("0\n");                 //Output : If either the initial or terminal cell has a cell detector, no of ways =0
            continue;
        }
        printf("%d\n(\n", ans);            //Output : No. of possible paths
        for(int i=0; i<27; i++)
        {
            for(int j=0; j<27; j++)
            visited[i][j]=0;               //initializing visited[i][j]=0 for dfs2
        }
        visited[0][0]=1, xcor[0]=ycor[0]=0, siz=1;
        dfs2(0, 0);                        //dfs2 function for printing each path
        printf(")\n");                     //Output : Closing the final parenthesis in o/p.
    }
    return 0;
}