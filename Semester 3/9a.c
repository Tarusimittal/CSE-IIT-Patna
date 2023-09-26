//Tarusi Mittal
//1901CS65
#include<stdio.h>
#include<stdlib.h>
#define in scanf
#define out printf

//for structring a graph
struct graph{
    int data;
    int weight;
    struct graph*next;
};
struct graph*CreateNewNode(int ele,int r,struct graph*temp){
	int te;
    struct graph*Nnode=(struct graph*)malloc(sizeof(struct graph));
    Nnode->data=ele, Nnode->weight=r; Nnode->next=temp;
    return Nnode;
}
struct node{
	int ele;
	struct node*right;
	int temp;
};
struct node*formnode(int ele){
	struct node*formednode=(struct node*)malloc(sizeof(struct node));
	formednode->right=NULL;
	int temp;
	formednode->ele=ele;
	temp++;
	return formednode;
}

//for insertion of edge
void insert(struct node**head,struct node**trav,int s){
	if(*head!=NULL){
		(*trav)->right=formnode(s);
		(*trav)=(*trav)->right;
	}
	else
		*head=*trav=formnode(s);
}


//main function
int main(){
    //taking the inputs
    int n,m, flag;
    scanf("%d%d",&n,&m);
    int v,s;
    //constructing a graph
    struct graph*edges[n+1];
    int i, u;
    
    //distance array to store distance between the shops
    //visited array store whether that node is visited or not
    //shop stores the nearest soda shop
    int distance[n+1],visited[n+1], shop[n+1];
    for(i=1;i<=n;){
        //initialysing all variables
        distance[i]=1000000000;
        edges[i]=NULL;
		visited[i++]=0;
    }
    for(i=1;i<=m;){
        in("%d%d%d",&u,&v,&s);
        edges[u]=CreateNewNode(v,s,edges[u]);
        flag=u;
		edges[v]=CreateNewNode(u,s,edges[v]);
		i++;
	}
	
	int cnt=1;
	in("%d",&u);
	struct node*head=NULL,*trav;
    while(u--){
        //taking input of the soda shops 
         in("%d",&s);
         //for that node distnace becomes 0
         distance[s]=0;
         flag++;
         insert(&head,&trav,s);
         visited[s]=1;
         flag+=visited[s];
         //nearest shop is that soda shop itself
         shop[s]=s;
    }
    
    //the loop to check the minimu distance
    //and also it stores the corresponding soda shop
	for(;head!=NULL;head=head->right){
		struct graph*temp=edges[head->ele];
		visited[head->ele]=0;
	    for(;temp!=NULL;temp=temp->next){
		   if(visited[temp->data]==0){
		       //if that node is not vivited we will check the distance from all soda shops
		   		if((distance[head->ele]+temp->weight)-distance[temp->data]<0){	
               		insert(&head,&trav,temp->data);
			   		distance[temp->data]=distance[head->ele];
			   		distance[temp->data]+=temp->weight;
			   		visited[temp->data]=0;
		       		shop[temp->data]=shop[head->ele];
		       		visited[temp->data]++;  
		   		}
		   }
		   else if(visited[temp->data]!=0){
		       //if it stands visited and is not zero
		   		if((distance[head->ele]+temp->weight)-distance[temp->data]<0){
			   		distance[temp->data]=distance[head->ele];
			   		distance[temp->data]+=temp->weight;
		       		shop[temp->data]=shop[head->ele];
		   		}
		   }
	  	}
	}
	
	i=1;
    while(i<=n){
     //loop to print out the distance and the nearest soda shop no
     out("%d %d\n",distance[i],shop[i]);
     i++;
	}
}