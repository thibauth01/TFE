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
          <View style={styles.view_button_Email}>
            <Button
              icon={
                <View style={styles.view_Icon}>
                  <Icon
                    name="envelope"
                    size={20}
                    color="#C8D1D3"
                    style={styles.Icon_Email}
                  />
                </View>
              }
              buttonStyle={styles.buttonStyle_Email}
              titleStyle={styles.titleStyleButton_Email}
              title="SIGN UP WITH EMAIL"
              type="solid"
            />
          </View>

          <View style={styles.view_button_Facebook}>
            <Button
              icon={
                <View style={styles.view_Icon}>
                  <Icon
                    name="facebook"
                    size={20}
                    color="white"
                    style={styles.Icon_Facebook}
                  />
                </View>
              }
              buttonStyle={styles.buttonStyle_Facebook}
              titleStyle={styles.titleStyleButton_Facebook}
              title="SIGN UP WITH FACEBOOK"
              type="solid"
            />
          </View>
          
        
        </View>

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
    flex:1,
    justifyContent:"center",
    
    
  },
  view_button_Email:{
    margin:18

  },
  buttonStyle_Email:{
    
    height:50,
    backgroundColor: "white",
    borderRadius:20,
    shadowColor: "#000",
    shadowOffset: {
      width: 0,
      height: 2,
    },
    shadowOpacity: 0.25,
    shadowRadius: 3.84,
    elevation: 5,
    
  },
  titleStyleButton_Email:{
    color: "#1B1C20", 
    
    
    
  },
  view_Icon:{
    marginRight:20
  },
  Icon_Email:{
    

  },


  view_button_Facebook:{
    margin:18
  },
  buttonStyle_Facebook:{
    
    height:50,
    backgroundColor: "#4285f4",
    borderRadius:20,
    shadowColor: "#000",
    shadowOffset: {
      width: 0,
      height: 2,
    },
    shadowOpacity: 0.25,
    shadowRadius: 3.84,
    elevation: 5,

  },
  titleStyleButton_Facebook:{
    color: "white", 
    

  },
  
  Icon_Facebook:{

  }
 


})

export default SignUp