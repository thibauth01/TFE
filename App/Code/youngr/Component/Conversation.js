import React from 'react'
import { StyleSheet,Image,View,Platform,SafeAreaView, ImageBackground,Linking,TouchableOpacity,FlatList } from 'react-native'
import {Button,Text, Block, Input, Icon} from 'galio-framework'
import { theme } from '../Constants';
import { connect } from 'react-redux'
import CardConv from './CardConv'


class Conversation extends React.Component {

  constructor(props) {
    super(props)
    this.state = {
      conv:undefined,
      viewConv:undefined
    }
  }

  componentDidMount(){
    this.getData().then(response => this.setState({conv:response},()=>{
      this.showListMsg();
    }));  
  }

  getData(){
    return fetch('http://192.168.1.56/TFE/Web/plateform/api/conversations.php',{
      method:'POST',
      header:{
        'Accept': 'application/json',
        'Content-type': 'application/json'
      },
      body:JSON.stringify({
        type: this.props.account.type,
        idAccount: this.props.account.id
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

  

  showListMsg(){
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


  render() {
   
    return (
        <Block style={styles.main_container}>
          <Block >
            <Text h4 muted style={styles.subtitle}>Mes conversations</Text>
              {this.state.viewConv}   
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
    paddingLeft:10,
    marginBottom:5
  },
  

})

const mapStateToProps = (state) =>{
  return {
      account: state.account.account
  }
}

export default connect(mapStateToProps)(Conversation);