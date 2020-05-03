import React from "react";
import { View, Image,StyleSheet, TouchableOpacity, Dimensions } from "react-native";
import { Block,Text } from "galio-framework";
import { theme } from '../Constants';
import { NavigationEvents } from 'react-navigation';

import {getAge,reformatDate,reformatTime,getPrice,mois,isNotTooLongText} from '../Constants/Utils'
import { connect } from "react-redux";



class CardConv extends React.Component { 
    interval = 0;

    constructor(props){
        super(props);

        this.state={
            maxCharMessage : 55,
            maxCharTitle:30,
            lastMessage:undefined,
            colorLastMessage:undefined,
        }
    }

    componentDidMount(){
        this.showMessage();

        this.props.navigate.addListener('willFocus', async () =>{
            this.timer();
        });
        this.props.navigate.addListener('willBlur', () => {
            clearInterval(this.interval);
        });
        
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

    showMessage(){
        this.getData().then(response => this.setState({lastMessage:response},()=>{
            if(this.state.lastMessage.isRead == 1 || this.props.account.idTypeAccount == this.state.lastMessage.id_sender){
                this.setState({
                    colorLastMessage : theme.COLORS.MUTED
                })
            }
            else{
                this.setState({
                    colorLastMessage : theme.COLORS.GITHUB
                })
            }
        }));
        
    }

    timer(){
        this.interval = setInterval(() => {
            this.showMessage();

        }, 5000);
    }

    

    showLastDate(){
        if(this.state.lastMessage != undefined && this.state.lastMessage != false){

            const date = this.state.lastMessage.sendtime.slice(0,10);
            const dateMoment = new Date(date);

            return (
                <Text color={theme.COLORS.SECONDARY}>{dateMoment.getDate() + " " +  mois[dateMoment.getMonth()]}</Text> 
            )
        }
        
      
    }

    


    render() { 

        const {navigate} = this.props.navigate
        
      return (
          
        <TouchableOpacity
            onPress={() => navigate('Messages',this.props.item)}>
                
            <NavigationEvents
                onDidFocus={() => this.componentDidMount()}
            />
            <Block flex={1} style={styles.block_main} height={70} row middle>
                <Block flex={1.3}>
                    <Image style={styles.profile} source={require(`../Images/avatar.jpg`)}></Image>
                </Block>
                <Block flex={3} >
                    <Block>
                        <Text size={16}>{isNotTooLongText(this.props.item.title,this.state.maxCharTitle)}</Text>
                    </Block>
                    <Block>
                        <Text size={14} italic color={this.state.colorLastMessage}>{this.state.lastMessage != undefined ? this.state.lastMessage.content:""}</Text>
                    </Block>
                    
                </Block>
                
                <Block flex={1} style={{marginRight:10}} right>
                    {this.showLastDate()}
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

  const mapStateToProps = (state) =>{
    return {
        account: state.account.account
    }
  }

  export default connect(mapStateToProps)(CardConv)