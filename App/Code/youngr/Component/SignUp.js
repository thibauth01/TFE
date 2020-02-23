import React from 'react'
import { StyleSheet, View, TextInput, Text , Platform, Button, TouchableOpacity, Alert, Image  } from 'react-native'



class SignUp extends React.Component {

  constructor(props) {
     super(props)
     this.state = {
      
    }
   }


  render() {
    return (

      <View style={styles.text_main}>
        {/*  Titre*/}
        <View style={styles.view_text_titre}>
          <Text style={styles.text_titre1}>Shivoo</Text>
          <Text style={styles.text_titre2}>Private</Text>
        </View>
        
        {/*  cjamps à remplir*/}     
        <View style={styles.view_Aremplir}>

          <View style={styles.view_Aremplir_label}>
            
            <View style={styles.input}>
              <View>
              <Text style={styles.text_titre3}>Sign Up</Text>
              </View>
            </View>

            <View style={styles.input}>
              <View style={styles.label}>
                <Text>NAME*</Text>
              </View>
              <View style={styles.champs}>
                <Text></Text>
              </View>
            </View>

            <View style={styles.input}>
              <View style={styles.label}>
                <Text>FIRST NAME*</Text>
              </View>
              <View style={styles.champs}>
                <Text></Text>
              </View>
            </View>
            
            <View style={styles.input}>
              <View style={styles.label}>
                <Text>EMAIL*</Text>
              </View>
              <View style={styles.champs}>
                <Text></Text>
              </View>
            </View>

            <View style={styles.input}>
              <View style={styles.label}>
                <Text>PHONE NUMBER</Text>
              </View>
              <View style={styles.champs}>
                <Text></Text>
              </View>
            </View>

            <View style={styles.input}>
              <View style={styles.label}>
                <Text>PASSWORD*</Text>
              </View>
              <View style={styles.champs}>
                <Text></Text>
              </View>
            </View>


            <View style={styles.input}>
              <View style={styles.signup}>
                <Text style={styles.signup_text}>Sign Up</Text>
              </View>
            </View>
           </View>


        </View>



          {/*  sigin */} 
        <View style={styles.view_text_signin}>
          <Text style={styles.view_text_signin1}>
          Already registered?
          </Text>
          <Text style={styles.view_text_signin2}>
          Sign In
          </Text>
        </View>
      </View>
      

    )
  }
}

const styles = StyleSheet.create({
   
  text_main: {
    flex: 1,
    backgroundColor: '#FFFFFF'
  },


  //titre
  view_text_titre:{
    flex: 0.2,
    justifyContent: 'center'
  },
  text_titre1:{
    color:"#376944",
    fontSize: 50,
    textAlign: 'center',
  },
  text_titre2:{
    fontSize: 20,
    textAlign: 'center',
  },

  text_titre3:{
    fontSize: 20,
    width: 303, 
  },
  //champs à remplir
  view_Aremplir:{
    flex:0.7,
  },
  view_Aremplir_label:{
    alignItems: 'center',
  },
  label:{
    fontSize:15,
    paddingBottom:2
  },
  champs:{
    backgroundColor: '#F7F8F9',
    width: 303, 
    height: 44,
    borderRadius: 10,
    shadowOpacity: .2,
  },
  input:{
    marginTop:15
  },

  //signup
  signup:{
    backgroundColor: '#376944',
    width: 303, 
    height: 60,
    borderRadius: 10,
    justifyContent: 'center',
    alignItems: 'center',
    marginTop:20,
  },
  signup_text:{
    color:'#FFFFFF',
    fontSize:28,
  },
   //bas de page
   view_text_signin:{
    flex: 0.1,
    alignItems: 'center',
  },
  view_text_signin1:{
    color:"#000000",
    fontSize:15
  },
  view_text_signin2:{
    color:"#376944",
    fontSize:15,
    textDecorationLine: 'underline'
  },
})

export default SignUp