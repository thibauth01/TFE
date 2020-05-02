import React from "react";
import { View, Image,StyleSheet, TouchableOpacity, Dimensions } from "react-native";
import { Block,Text } from "galio-framework";
import { theme } from '../Constants';
import {getAge,reformatDate,reformatTime,getPrice,mois,isNotTooLongText} from '../Constants/Utils'



export default class CardConv extends React.Component { 

    constructor(props){
        super(props);
        this.state={
            maxCharMessage : 55,
            maxCharTitle:30,
            lastMessage:""
        }
    }

    componentDidMount(){
        this.getData().then(response => this.setState({lastMessage:response}));  
    }

    getData(){
        return fetch('http://192.168.1.56/TFE/Web/plateform/api/lastMessage.php',{
            method:'POST',
            header:{
                'Accept': 'application/json',
                'Content-type': 'application/json'
            },
            body:JSON.stringify({
                idWork: this.props.item.id
            })
            
        })
        .then((response) => response.json())
            .then((responseJson)=>{
                return responseJson.data;
            
            })
            .catch((error)=>{
                console.error(error);
            });

        
    }

    getDate(date){
     
        const dateMoment = new Date(date);

        return (
            <Text color={theme.COLORS.SECONDARY}>{dateMoment.getDate() + " " +  mois[dateMoment.getMonth()]}</Text> 
        )
      
    }

    showLastMessage(){
        if(this.state.lastMessage != undefined){
            return(
                this.state.lastMessage.content
            )
        }
    }


    render() { 

        const {navigate} = this.props.navigate
        const date = this.getDate("2000-05-15");
        
      return (
        <TouchableOpacity
            onPress={() => navigate('Messages',this.props.item)}>
            <Block flex={1} style={styles.block_main} height={70} row middle>
                <Block flex={1.3}>
                    <Image style={styles.profile} source={require(`../Images/avatar.jpg`)}></Image>
                </Block>
                <Block flex={3} >
                    <Block>
                        <Text size={16}>{isNotTooLongText(this.props.item.title,this.state.maxCharTitle)}</Text>
                    </Block>
                    <Block>
                        <Text size={14} muted>{this.showLastMessage()}</Text>
                    </Block>
                    
                </Block>
                
                <Block flex={1} style={{marginRight:10}} right>
                    {date}
                </Block>
            </Block>
        </TouchableOpacity>
         
      );
    }
  }

  const styles = StyleSheet.create({
    block_main:{
        width:Dimensions.get("window").width -10,
        backgroundColor:theme.COLORS.DEFAULT,
        marginTop:10,
        marginBottom:5,
        borderRadius:10,
        shadowColor: "#000",
        shadowOffset: {
          width: 0,
          height: 2,
        },
        shadowOpacity: 0.23,
        shadowRadius: 2.62,
        elevation: 4,
        overflow: 'hidden'
    },
    profile: {
        width:65,
        height:65,
        borderRadius:10,
        marginLeft:3
    },
  
  
  })