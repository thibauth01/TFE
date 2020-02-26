import React from 'react'
import { StyleSheet, View, TextInput, Text , Platform, TouchableOpacity, Alert, Image  } from 'react-native'
import { createMaterialTopTabNavigator } from '@react-navigation/material-top-tabs'
import { Button } from 'react-native-elements';
import Icon from 'react-native-vector-icons/FontAwesome';
import { color } from 'react-native-reanimated';


const Tab = createMaterialTopTabNavigator();


class SignUp extends React.Component {

  constructor(props) {
     super(props)
     this.state = {
      
    }
   }


  render() {
    return (
      <View style={styles.main_container}>

        
        <View style={styles.body_container}>
        <Button
          icon={
            <Icon
              name="envelope"
              size={15}
              color="black"
            />
          }
          buttonStyle={styles.button_signUp}
          title="Sign Up Here"
          type="solid"
        />
        </View>

      </View>
    )
  }
}

const styles = StyleSheet.create({
   
  main_container: {
    flex: 1,
    backgroundColor:"#334856",
    fontFamily:"Roboto",
    
  },



  /*Body*/
  body_container:{
    backgroundColor:"#273640",
    flex:1,
    justifyContent:"center",
    
    
  },

  button_signUp:{
    marginLeft:10,
    marginRight:10,
    height:50,
    backgroundColor: "grey",
    borderRadius:30,
  }


})

export default SignUp