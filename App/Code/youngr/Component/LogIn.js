import React from 'react'
import { StyleSheet, View, TextInput, Text , Platform, Button, TouchableOpacity, Alert, Image  } from 'react-native'
import { createMaterialTopTabNavigator } from '@react-navigation/material-top-tabs'



class LogIn extends React.Component {

  constructor(props) {
     super(props)
     this.state = {
      
    }
   }


  render() {
    return (
      <View style={styles.main_container}>

        <Text>LogIn Here</Text>

      </View>
    )
  }
}

const styles = StyleSheet.create({
   
  main_container: {
    flex: 1,
    backgroundColor:"#334856",
    fontFamily:"Roboto"
  },

  
})

export default LogIn