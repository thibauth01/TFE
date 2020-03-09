import React from 'react'
import { StyleSheet, View, Dimensions,TextInput, Text ,KeyboardAvoidingView,SafeAreaView, Platform, TouchableOpacity, Alert, Image  } from 'react-native'
import { createMaterialTopTabNavigator } from '@react-navigation/material-top-tabs'
import { Button , Input } from 'react-native-elements';
import Icon from 'react-native-vector-icons/FontAwesome';
import { color } from 'react-native-reanimated';


class SignUp extends React.Component {

  constructor(props) {
     super(props)
     this.state = {
      
    }
   }


  render() {
    return (
      
      <View style={styles.main_container}>
        <SafeAreaView>
         
          

            <View style={styles.view_text}>
              <Text style={styles.text}>Create your account</Text>
            </View>

            <View style={styles.view_inputs}>
              <View style={styles.view_input}>
                <Input
                  style={styles.input}
                  placeholder='Username'
                  inputContainerStyle={{borderBottomWidth:0}}
                  leftIcon={
                    <View style={styles.view_icon}>
                      <Icon
                        name='user-o'
                        size={24}
                        color='#A6BCD0'
                        style={styles.icon}
                      />
                  </View>
                  
                  }
                  inputStyle={{color:"white"}}
                />
              </View>

              <View style={styles.view_input}>
                <Input
                  style={styles.input}
                  placeholder='Password'
                  secureTextEntry={true}
                  inputContainerStyle={{borderBottomWidth:0}}
                  leftIcon={
                    <View style={styles.view_icon}>
                      <Icon
                        name='lock'
                        size={24}
                        color='#A6BCD0'
                        style={styles.icon}
                      />
                  </View>
                  
                  }
                  inputStyle={{color:"white"}}
                />
              </View>
            </View>
          
        </SafeAreaView>
      </View>
      
    )
  }
}

const styles = StyleSheet.create({
   
  main_container: {
    flex: 1,
    backgroundColor:"#334856",
    fontFamily:"roboto-light",
    
  },

  /*Body*/
  body_container:{
    backgroundColor:"#273640",
    justifyContent:"center",
    
  },

  view_text:{
    flex:1,
    marginTop:20
    
  },
  text:{
    marginLeft:20,
    marginTop:10,
    color:'white',
    fontSize:25
  },
  view_inputs:{
    flex:1,
    marginTop:100
  },
  view_input:{
    backgroundColor:"#334856",
    height:40,
    borderRadius:10,
    
  },

  input:{
    color:"white"
  },
  


})

export default SignUp