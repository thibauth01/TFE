import React from 'react'
import { StyleSheet, View, KeyboardAvoidingView, TextInput, Text, Platform, TouchableOpacity, Alert, Image } from 'react-native'
import { createMaterialTopTabNavigator } from '@react-navigation/material-top-tabs'
import { Input, Button } from 'react-native-elements';
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

        {/*<View style={styles.view_welcome_text}>
          <Text style={styles.welcome_text}> Welcome back !</Text>
    </View>*/}

        <KeyboardAvoidingView behavior="padding" enabled>
          <View style={styles.view_input}>
            <Input
              style={styles.input}
              placeholder='Username'
              inputContainerStyle={{ borderBottomWidth: 0 }}
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
              inputStyle={{ color: "white" }}
            />
          </View>

          <View style={styles.view_input}>
            <Input
              style={styles.input}
              placeholder='Password'
              secureTextEntry={true}
              inputContainerStyle={{ borderBottomWidth: 0 }}
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
              inputStyle={{ color: "white" }}
            />
          </View>
        </KeyboardAvoidingView>

        <View style={styles.view_button}>
          <Button
            icon={
              <View style={styles.view_icon_button}>
                <Icon
                  name="arrow-circle-right"
                  size={30}
                  color="#D97D54"
                  style={styles.icon}
                />
              </View>
            }
            iconRight
            buttonStyle={styles.button_style}
            titleStyle={styles.title_style_button}
            title="LOG IN"
            type="solid"
          />
        </View>

        <View style={styles.view_button_facebook}>
          <Button
            icon={
              <View style={styles.view_icon_button}>
                <Icon
                  name="facebook"
                  size={30}
                  color="white"
                  style={styles.icon}
                />
              </View>
            }
            iconRight
            buttonStyle={styles.button_style_facebook}
            titleStyle={styles.title_style_button_facebook}
            title="LOG IN WITH FACEBOOK"
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
    backgroundColor: "#273640",
    fontFamily: "Roboto",

  },



  view_input: {
    backgroundColor: "#334856",
    height: 70,
    borderRadius: 10,
    marginLeft: 15,
    marginRight: 15,
    marginTop: 30,
    justifyContent: "center",
    alignItems: "center",
    borderWidth: 0,
    shadowColor: "#000",
    shadowOffset: {
      width: 0,
      height: 3,
    },
    shadowOpacity: 0.27,
    shadowRadius: 4.65,

    elevation: 6,
  },

  input: {
    color: "white"
  },
  view_icon: {
    marginRight: 20
  },
  icon: {

  },

  view_button: {
    marginLeft: 10,
    marginRight: 10,
    marginTop: 20,

  },

  button_style: {
    height: 60,
    backgroundColor: "white",
    borderRadius: 40,
    shadowColor: "#000",
    shadowOffset: {
      width: 0,
      height: 2,
    },
    shadowOpacity: 0.25,
    shadowRadius: 3.84,
    elevation: 5,
  },

  title_style_button: {
    color: "black",
    fontSize: 18,
  },
  view_icon_button: {
    marginLeft: 40
  },

  view_button_facebook: {
    marginLeft: 10,
    marginRight: 10,
    marginTop: 80,
  },
  button_style_facebook: {
    height: 60,
    backgroundColor: "#4285f4",
    borderRadius: 40,
    shadowColor: "#000",
    shadowOffset: {
      width: 0,
      height: 2,
    },
    shadowOpacity: 0.25,
    shadowRadius: 3.84,
    elevation: 5,
  },
  title_style_button_facebook: {

  }





})

export default LogIn