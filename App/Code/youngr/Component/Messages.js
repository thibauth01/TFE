import React from 'react'
import { StyleSheet,Image,View,Platform,SafeAreaView, ImageBackground,Linking,TouchableOpacity, Dimensions } from 'react-native'
import {Button,Text, Block, Input, Icon} from 'galio-framework'
import { theme } from '../Constants';
import { connect } from 'react-redux'
import {getAge,reformatDate,reformatTime,getPrice,loading} from '../Constants/Utils'




class Messages extends React.Component {

  constructor(props) {
    super(props)
    this.state = {
      idWork:undefined,
      idTypeAccount:undefined,
      messages:[],
      text:undefined,
      viewMessages:undefined
    }
  }

  componentDidMount(){
    this.setState({idWork:this.props.navigation.state.params.id},() => {
      this.getData().then(response => this.setState({messages:response},()=>{
        this.showMessages()
      }))
    });
    

  }

  getData(){
    return fetch('http://192.168.1.56/TFE/Web/plateform/api/messages.php',{
        method:'POST',
        header:{
            'Accept': 'application/json',
            'Content-type': 'application/json'
        },
        body:JSON.stringify({
            idWork: this.state.idWork,
            type: this.props.account.type,
            idAccount: this.props.account.id
        })
        
    })
    .then((response) => response.json())
        .then((responseJson)=>{
            this.setState({idTypeAccount:responseJson.idTypeAccount});
            return responseJson.data;
        
        })
        .catch((error)=>{
            console.error(error);
        });

  }

  showMessages(){
    if(this.state.messages != undefined){
      const view  = this.state.messages.map((props,key) => {
        if(props.id_sender == this.state.idTypeAccount){
          return(
            <Block right>
              <Block style={styles.msgMe}>
                <Text color={theme.COLORS.DEFAULT} size={16} style={styles.textMe}>{props.content}</Text>
              </Block>
            </Block>
          )
        }
        else{
          return(
            <Block left>
              <Block style={styles.msgOther} >
                <Text muted style={styles.textOther} size={16}> {props.content}</Text>
              </Block>
            </Block>
          )
        }
      });
      this.setState({viewMessages:view});
    }
    else{
      loading()
    }
    
  }

  sendMessage = () =>{
    console.log("send");
    if(this.state.text == undefined || this.state.text == ""){
      alert("Message vide")
    }
    else{

      const newView = 
        <Block right>
          <Block style={styles.msgMe}>
            <Text color={theme.COLORS.DEFAULT} size={16} style={styles.textMe}>{this.state.text}</Text>
          </Block>
        </Block>;
        
    
      this.setState({
        viewMessages:[...this.state.viewMessages, newView]
      });
            /*ARRIVER ICI =>  FAIRE L'ENVOIT DE MESSAGES (+ACTUALISATION AU RETOUR DEMANDER GAUTHIER) 
            MAIS AVANT CHANGER POST EN GET DE ASANA BISOU*/

    }
  }
  


  render() {
    return (
        <Block style={styles.main_container}>
          <Block style={styles.MessagesBox} flex={8}>
            {this.state.viewMessages}
          </Block>
          <Block style={styles.sendBar} flex={1}>
            <Block row>
              <Block flex={5} center>
                <Input 
                  flex={5}
                  placeholder="Votre message" 
                  right
                  borderless
                  family="antdesign"
                  iconColor={theme.COLORS.SECONDARY}
                  onChangeText={text => this.setState({text})}
                />
              </Block>
              <Block flex={1} center>
                <TouchableOpacity onPress={this.sendMessage}>
                  <Icon name="send" family="feather" size={25} color={theme.COLORS.SECONDARY}/>
                </TouchableOpacity>
              </Block>
            </Block>
          </Block>
        </Block>
    )
  }
}

const styles = StyleSheet.create({

  main_container: {
    flex:1,
    backgroundColor:theme.COLORS.BACKGROUND,
    flexDirection:"column"
  },
  MessagesBox:{
    justifyContent:"flex-end",
    marginTop:20,
    marginBottom:10
  },

  msgMe:{
    backgroundColor:theme.COLORS.SECONDARY,
    maxWidth:Dimensions.get("window").width -50,
    minHeight:40,
    borderTopLeftRadius:10,
    borderBottomLeftRadius:10,
    justifyContent:"center",
    marginBottom:7,

  },
  textMe:{
    paddingLeft:15,
    paddingRight:15
  },
  msgOther:{
    backgroundColor:theme.COLORS.DEFAULT,
    maxWidth:Dimensions.get("window").width -50,
    minHeight:40,
    borderTopRightRadius:10,
    borderBottomRightRadius:10,
    justifyContent:"center",
    marginBottom:7,
    

  },
  textOther:{
    paddingLeft:15,
    paddingRight:15
  },
  sendBar:{
    flex:1,
    justifyContent:"flex-end",
    marginLeft:20,
    marginRight:10,
    marginBottom:15
  }

})

const mapStateToProps = (state) =>{
  return {
      account: state.account.account
  }
}

export default connect(mapStateToProps)(Messages);