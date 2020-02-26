import React from 'react'
import { StyleSheet, View, TextInput, Text , Platform, Button, TouchableOpacity, Alert, Image  } from 'react-native'
import { createMaterialTopTabNavigator } from '@react-navigation/material-top-tabs'
import { Input } from 'react-native-elements';
import Icon from 'react-native-vector-icons/FontAwesome';


class LogIn extends React.Component {

  constructor(props) {
     super(props)
     this.state = {
      
    }
   }


  render() {
    return (
      <View style={styles.main_container}>

        <View style={styles.view_username}>
          <Input
            placeholder='Username'
            leftIcon={
              <Icon
                name='user-o'
                size={24}
                color='#A6BCD0'
              />
            
            }
            inputStyle={{color:"#A6BCD0"}}
          />
        </View>

      </View>
    )
  }
}

const styles = StyleSheet.create({
   
  main_container: {
    flex: 1,
    backgroundColor:"#273640",
    fontFamily:"Roboto"
  },

  view_username:{

  },

  input:{
    backgroundColor:"#334856",
    height:50,
    borderRadius:10,
    margin:20
    
  }
  
})

export default LogIn