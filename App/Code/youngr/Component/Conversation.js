import React from 'react'
import { StyleSheet,Image,View,Platform,SafeAreaView, ImageBackground,Linking,TouchableOpacity,FlatList } from 'react-native'
import {Button,Text, Block, Input, Icon} from 'galio-framework'
import { theme } from '../Constants';
import { connect } from 'react-redux'
import CardConv from './CardConv'

const data = [
  {
    'title':'titre iuefhreg re g trg  tezgsr ez gfrez g re gre ers g res  g resg ',
    'lastMessage':'coucou toi comment tu vas ? enculé de test grands mort quest ce quil y a',
    'date_start':'2020-05-10'
  },
  {
    'title':'titre2',
    'lastMessage':'coucou2',
    'date_start':'2020-05-10'

  },
  {
    'title':'titre3',
    'lastMessage':'coucou3',
    'date_start':'2020-05-10'

  },

];

class Conversation extends React.Component {

  constructor(props) {
    super(props)
    this.state = {
      conv:undefined
    }
  }

  componentDidMount(){
    this.getData().then(response => this.setState({conv:response}));  
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
    return(
      <FlatList
        data={this.state.conv}
        renderItem={({ item }) => <CardConv 
                                    navigate={this.props.navigation}
                                    item={item}
                                  />}
        keyExtractor={item => item.id}
      />
    )
  }


  render() {
   
    return (
        <Block style={styles.main_container}>
          <Block >
            <Text h4 muted style={styles.subtitle}>Mes conversations</Text>
              {this.showListMsg()}   
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