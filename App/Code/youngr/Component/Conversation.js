import React from 'react'
import { StyleSheet,Image,View,Platform,SafeAreaView,Dimensions, ImageBackground,Linking,TouchableOpacity,FlatList } from 'react-native'
import {Button,Text, Block, Input, Icon} from 'galio-framework'
import { theme } from '../Constants';
import { connect } from 'react-redux'
import CardConv from './CardConv'


class Conversation extends React.Component {

  interval = 0;
  constructor(props) {
    super(props)
    this.state = {
      conv:undefined,
      viewConv:undefined,
    }
  }

  componentDidMount(){
    this.getData().then(response => this.setState({conv:response},()=>{
      this.showListMsg();
    })); 

    this.props.navigation.addListener('willFocus', async () =>{
      this.timer();
    });
    this.props.navigation.addListener('willBlur', () => {
        clearInterval(this.interval);
    });
  }

  
  

  getData(){
    return fetch('https://dashboard.youngr.be/api/conversations.php',{
      method:'POST',
      header:{
        'Accept': 'application/json',
        'Content-type': 'application/json'
      },
      body:JSON.stringify({
        type: this.props.account.type,
        idAccount: this.props.account.id,
        jwt:this.props.account.jwt
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

  timer(){
    this.interval = setInterval(() => {
      this.getData().then(response => this.setState({conv:response},()=>{
        this.showListMsg();
      }));
    }, 5000);
  }

  

  showListMsg(){
    if(this.state.conv.length > 0){
       const view =
      <FlatList
        data={this.state.conv}
        renderItem={({ item }) => <CardConv 
                                    navigate={this.props.navigation}
                                    item={item}
                                  />}
        keyExtractor={item => item.id}
      />

      this.setState({viewConv:view});


    }
    else{
       const view =
        <Block middle style={styles.noWork}>
          <Text h5> Aucune conversation</Text>
        </Block>
        
        this.setState({viewConv:view});

    }
    
    
  }


  render() {
   
    return (
        <Block style={styles.main_container}>
          <Block >
            <Text h4 muted style={styles.subtitle}>Mes conversations</Text>
            <Block middle>
              {this.state.viewConv}   

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
  },
  subtitle:{
    marginTop:10,
    paddingLeft:20,
    marginBottom:5
  },
  noWork:{
    marginBottom:10,
    backgroundColor:theme.COLORS.DEFAULT,
    marginLeft:10,
    height:50,
    borderRadius:10,
    width:Dimensions.get("window").width-20
  }
  

})

const mapStateToProps = (state) =>{
  return {
      account: state.account.account
  }
}

export default connect(mapStateToProps)(Conversation);