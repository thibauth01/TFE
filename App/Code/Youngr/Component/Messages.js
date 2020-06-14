import React from 'react'
import { StyleSheet,Image,View,Platform,SafeAreaView, ImageBackground,Linking,TouchableOpacity, Dimensions, ScrollView } from 'react-native'
import {Button,Text, Block, Input, Icon} from 'galio-framework'
import { theme } from '../Constants';
import { connect } from 'react-redux'
import {getAge,reformatDate,reformatTime,getPrice,loading} from '../Constants/Utils'
import { Keyboard } from 'react-native'





class Messages extends React.Component {
  interval = 0;

  constructor(props) {
    super(props)
    this.state = {
      idWork:undefined,
      idTypeAccount:undefined,
      messages:[],
      text:undefined,
      viewMessages:undefined,
      numberOfMessages:0,
      interval:undefined
    }
  }

  componentDidMount(){
    this.setState({idWork:this.props.navigation.state.params.id},() => {
      this.getData().then(response => this.setState({messages:response},()=>{
        this.showMessages()
      }))
    });
  
    this.timer();

  }

  componentWillUnmount() {
    clearInterval(interval);
  }


  timer(){
      interval = setInterval(() => {
        console.log("time");
        fetch('https://dashboard.youngr.be/api/numberOfMessages.php',{
          method:'POST',
          header:{
              'Accept': 'application/json',
              'Content-type': 'application/json'
          },
          body:JSON.stringify({
              idWork: this.state.idWork,
              idAccount: this.props.account.id,
              jwt:this.props.account.jwt
          })
          
      })
      .then((response) => response.json())
          .then((responseJson)=>{
              if(responseJson.data.count > this.state.numberOfMessages){
                this.getData().then(response => this.setState({messages:response},()=>{
                  this.showMessages()
                }));
                this.setState({numberOfMessages:responseJson.data.count})
              }
          })
          .catch((error)=>{
              console.error(error);
          });

    }, 5000);
  }


  getData(){
    return fetch('https://dashboard.youngr.be/api/messages.php',{
        method:'POST',
        header:{
            'Accept': 'application/json',
            'Content-type': 'application/json'
        },
        body:JSON.stringify({
            idWork: this.state.idWork,
            type: this.props.account.type,
            idAccount: this.props.account.id,
            jwt:this.props.account.jwt
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
            <Block right style={styles.blockMsg}>
              <Block style={styles.msgMe}>
                <Text color={theme.COLORS.DEFAULT} size={16} style={styles.textMe}>{props.content}</Text>
              </Block>
             
            </Block>
          )
        }
        else{
          return(
            <Block left style={styles.blockMsg}>
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


      fetch('https://dashboard.youngr.be/api/sendMessage.php',{
        method:'POST',
        header:{
            'Accept': 'application/json',
            'Content-type': 'application/json'
        },
        body:JSON.stringify({
            idWork: this.state.idWork,
            type: this.props.account.type,
            idAccount: this.props.account.id,
            content:this.state.text,
            jwt:this.props.account.jwt
        })
        
    })
    .then((response) => response.json())
        .then((responseJson)=>{
            if(responseJson.txt != null){
              alert(responseJson.txt);
            }
            this.setState({text:undefined})
            Keyboard.dismiss()
        
        })
        .catch((error)=>{
            console.error(error);
        });
    }
  }
  


  render() {
    return (
        <Block style={styles.main_container}>
          <Block style={styles.MessagesBox} flex={8}>
            <ScrollView 
              ref={ref => {this.scrollView = ref}}
              onContentSizeChange={() => this.scrollView.scrollToEnd({animated: true})}
            >
              {this.state.viewMessages}
            </ScrollView>
          </Block>
          <Block style={styles.sendBar} flex={1}>
            <Block row>
              <Block flex={5} center>
                <Input 
                  flex={5}
                  placeholder="Votre message" 
                  right
                  borderless
                  iconColor={theme.COLORS.SECONDARY}
                  value={this.state.text}
                  onChangeText={text => this.setState({text})}
                />
              </Block>
              <Block flex={1} center>
                <TouchableOpacity onPress={this.sendMessage}>
                  <Icon name="send" family="ionicons" size={30} color={theme.COLORS.SECONDARY}/>
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
  blockMsg:{
    marginBottom:10,
  },
  timeSend:{
    marginLeft:10,
    marginRight:10
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