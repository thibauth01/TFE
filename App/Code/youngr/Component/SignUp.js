import React from 'react'
import { StyleSheet, View, Dimensions, TextInput, Text, KeyboardAvoidingView, SafeAreaView, Platform, ScrollView, TouchableOpacity, Alert, Image } from 'react-native'
import { createMaterialTopTabNavigator } from '@react-navigation/material-top-tabs'
import { Button, Input } from 'react-native-elements';
import Icon from 'react-native-vector-icons/FontAwesome';
import DatePicker from 'react-native-datepicker';
import RNPickerSelect from 'react-native-picker-select';
import { color } from 'react-native-reanimated';


class SignUp extends React.Component {

  constructor(props) {
    super(props)
    this.state = {

    }
  }


  render() {
    var today = new Date().getDate();
   
    return (

      <View style={styles.main_container}>

        <View style={styles.view_text}>
          <Text style={styles.text}>Create your account</Text>
        </View>

        <ScrollView>

          <View style={styles.view_inputs}>



            {/*           LAST NAME          */}
            <View style={styles.view_input}>
              <Input
                style={styles.input}
                placeholder='Last Name'
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


            {/*           FIRST NAME          */}
            <View style={styles.view_input}>
              <Input
                style={styles.input}
                placeholder='First Name'
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


            {/*           EMAIL          */}

            <View style={styles.view_input}>
              <Input
                style={styles.input}
                placeholder='Email'
                inputContainerStyle={{ borderBottomWidth: 0 }}
                leftIcon={
                  <View style={styles.view_icon}>
                    <Icon
                      name='envelope-o'
                      size={24}
                      color='#A6BCD0'
                      style={styles.icon}
                    />
                  </View>

                }
                inputStyle={{ color: "white" }}
              />
            </View>


            {/*           USERNAME          */}

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



            {/*           PASSWORD          */}
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




            {/*           COMFIRM PASSWORD          */}
            <View style={styles.view_input}>
              <Input
                style={styles.input}
                placeholder='Confirm Password'
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



            {/*           Birth Date          */}
            <View style={styles.view_input}>
              <DatePicker
                style={styles.input}
                mode="date"
                placeholder="Birth Date"
                format="DD-MM-YYYY"
                minDate="1900-01-01"
                confirmBtnText="Confirm"
                cancelBtnText="Cancel"

              >

              </DatePicker>
            </View>




            {/*       Street        */}
            <View style={styles.view_input}>
              <Input
                style={styles.input}
                placeholder='Street'
                inputContainerStyle={{ borderBottomWidth: 0 }}
                leftIcon={
                  <View style={styles.view_icon}>
                    <Icon
                      name='map-marker'
                      size={24}
                      color='#A6BCD0'
                      style={styles.icon}
                    />
                  </View>

                }
                inputStyle={{ color: "white" }}
              />
            </View>


            {/*       N°        */}
            <View style={styles.view_inputs_short}>
              <View style={styles.view_input_short}>
                <Input
                  style={styles.input}
                  placeholder='N°'
                  inputContainerStyle={{ borderBottomWidth: 0 }}
                  leftIcon={
                    <View style={styles.view_icon}>
                      <Icon
                        name='map-marker'
                        size={24}
                        color='#A6BCD0'
                        style={styles.icon}
                      />
                    </View>

                  }
                  inputStyle={{ color: "white" }}
                />
              </View>

              {/*       Post Code        */}
              <View style={styles.view_input_short}>
                <Input
                  style={styles.input}
                  placeholder='Post Code '
                  inputContainerStyle={{ borderBottomWidth: 0 }}
                  leftIcon={
                    <View style={styles.view_icon}>
                      <Icon
                        name='map-marker'
                        size={24}
                        color='#A6BCD0'
                        style={styles.icon}
                      />
                    </View>

                  }
                  inputStyle={{ color: "white" }}
                />
              </View>
            </View>

            {/*       City        */}
            <View style={styles.view_input}>
              <Input
                style={styles.input}
                placeholder='City'
                inputContainerStyle={{ borderBottomWidth: 0 }}
                leftIcon={
                  <View style={styles.view_icon}>
                    <Icon
                      name='map-marker'
                      size={24}
                      color='#A6BCD0'
                      style={styles.icon}
                    />
                  </View>

                }
                inputStyle={{ color: "white" }}
              />
            </View>




            {/*       Country        */}
            <View style={styles.view_input}>
              <RNPickerSelect
                
                style={styles.input}
                items={[
                  { label: 'Football', value: 'football' },
                  { label: 'Baseball', value: 'baseball' },
                  { label: 'Hockey', value: 'hockey' },
                ]}
                onValueChange={(value) => console.log(value)}
              />
            </View>








          </View>

          <View style={styles.view_buttons}>

            {/*    BUTTON  WORKER     */}
            <View style={styles.view_button_worker}> 
              <Button
              icon={
                <View style={styles.view_icon_button}>
                  <Icon
                    name="arrow-right"
                    size={20}
                    color="#D97D54"
                    style={styles.icon}
                  />
                </View>
              }
              iconRight
              buttonStyle={styles.style_button_worker}
              titleStyle={styles.title_style_button_worker}
              title="I AM A WORKER"
              type="solid"
            />
            </View>

            {/*    BUTTON  REQUESTER     */}
            <View style={styles.view_button_requester}> 
              <Button
              icon={
                <View style={styles.view_icon_button}>
                  <Icon
                    name="arrow-right"
                    size={20}
                    color="white"
                    style={styles.icon}
                  />
                </View>
              }
              iconRight
              buttonStyle={styles.style_button_requester}
              titleStyle={styles.title_style_button_requester}
              title="I AM A REQUESTER"
              type="solid"
            />
            </View>

          </View>

        </ScrollView>

      </View>

    )
  }
}

const styles = StyleSheet.create({

  main_container: {
    flex: 1,
    backgroundColor: "#273640",
    fontFamily: "Roboto"

  },

  /*Body*/
  body_container: {
    backgroundColor: "#273640",
    justifyContent: "center",

  },

  view_text: {
    flex: 1,
    marginTop: 45

  },

  text: {
    marginLeft: 20,
    marginTop: 10,
    color: 'white',
    fontSize: 30
  },

  view_inputs: {
    flex: 1,
    marginTop: 80,
    marginBottom: 15
  },

  view_inputs_short: {
    flexDirection: 'row'
  },

  view_input: {
    backgroundColor: "#334856",
    height: 60,
    borderRadius: 10,
    marginLeft: 15,
    marginRight: 15,
    marginTop: 15,
    
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

  view_input_short: {
    backgroundColor: "#334856",
    height: 60,
    borderRadius: 10,
    marginLeft: 15,
    width: (Dimensions.get("window").width) / 2 - 23,
    marginTop: 15,
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


  view_buttons:{
    flexDirection:'row',
    justifyContent:"space-around"
  },

  view_button_worker:{
    width: (Dimensions.get("window").width) / 2 - 23,
    marginBottom: 30,
    marginTop: 20
  },

  view_button_requester:{
    width: (Dimensions.get("window").width) / 2 - 23,
    marginBottom: 30,
    marginTop: 20
  },

 

  style_button_worker:{
    backgroundColor:"white",
    borderRadius:40,
    height:50
  },
  style_button_requester:{
    backgroundColor:"#D97D54",
    borderRadius:40,
    height:50
  },
  title_style_button_worker:{
    color:'black',
    fontSize:12,
    marginRight:10
  },
  title_style_button_requester:{
    color:'white',
    fontSize:12,
    marginRight:10
  }



})

export default SignUp