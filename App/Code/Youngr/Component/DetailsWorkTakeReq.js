import React from 'react'
import { StyleSheet,Image,View,Platform,SafeAreaView, ImageBackground,Linking, Dimensions, ScrollView, TouchableOpacity } from 'react-native'
import {Button,Text, Block, Input, Icon} from 'galio-framework'
import { theme } from '../Constants';
import {getAge,reformatDate,reformatTime,getPrice} from '../Constants/Utils'
import AwesomeAlert from 'react-native-awesome-alerts';
import { connect } from 'react-redux'


class DetailsWorkTakeReq extends React.Component {

  constructor(props) {
    super(props)
    this.state={
      showAlert:false,
      typeAlert:undefined,
      starCount:undefined,
      isModalOpen:true
    }
  }

  showAlert = (bool) => {
    if(bool == 1){
      this.setState({
        showAlert: true,
        typeAlert:1
      });
    }
    else if(bool == 2){
        this.setState({
            showAlert: true,
            typeAlert:2
          });
    }
    else{
      this.setState({
        showAlert: true,
        typeAlert:0
      });
    }
    
  };

  hideAlert = () => {
    this.setState({
      showAlert: false
    });
  };

 
  ratingCompleted(){
    console.log("rate");
    
  }

  finish = ()=>{
    const idWork = this.props.navigation.state.params.id;
    fetch('https://dashboard.youngr.be/api/finishWork.php',{
      method:'POST',
      header:{
          'Accept': 'application/json',
          'Content-type': 'application/json'
      },
      body:JSON.stringify({
          idWork: idWork,
          idAccount:this.props.account.id,
          firstName:this.props.account.first_name,
          lastName:this.props.account.last_name,
          jwt:this.props.account.jwt
      })
      
    })
    .then((response) => response.json())
        .then((responseJson)=>{
            if(!responseJson.status){
              alert("impossible de terminer")
            };
        
        })
        .catch((error)=>{
            console.error(error);
        });  
  }

  cancel=()=>{

    const idWork = this.props.navigation.state.params.id;
    fetch('https://dashboard.youngr.be/api/removeWork.php',{
      method:'POST',
      header:{
          'Accept': 'application/json',
          'Content-type': 'application/json'
      },
      body:JSON.stringify({
          idWork: idWork,
          firstName:this.props.account.first_name,
          lastName:this.props.account.last_name,
          isTake: true,
          jwt:this.props.account.jwt,
          idAccount:this.props.account.id

      })
      
    })
    .then((response) => response.json())
        .then((responseJson)=>{
            if(!responseJson.status){
              alert("impossible de supprimer")
            };
        
        })
        .catch((error)=>{
            console.error(error);
        }); 
  }


  free=()=>{

    const idWork = this.props.navigation.state.params.id;
    fetch('https://dashboard.youngr.be/api/refuseWorker.php',{
      method:'POST',
      header:{
          'Accept': 'application/json',
          'Content-type': 'application/json'
      },
      body:JSON.stringify({
          idWork: idWork,
          firstName:this.props.account.first_name,
          lastName:this.props.account.last_name,
          idAccount:this.props.account.id,
          jwt:this.props.account.jwt
      })
      
    })
    .then((response) => response.json())
        .then((responseJson)=>{
            if(!responseJson.status){
              alert("impossible de supprimer")
            };
        
        })
        .catch((error)=>{
            console.error(error);
        }); 
  }


  render() {
    const {state} = this.props.navigation
    const path = `https://dashboard.youngr.be/`+state.params.profile_path;

    return (
        <Block style={styles.main_container}>
          
          <Block flex={1.2} style={styles.headerBlock}>
            <Block flex={1} style={styles.profileBlock}>
              <Image style={styles.profile} source={{uri:path}}></Image>
            </Block>
            <Block flex={2} style={styles.infoprofileBlock}>
              <Block row style={{marginLeft:10}}>
                <Text h4 muted>{state.params.first_name} {state.params.last_name}</Text> 
              </Block> 
              <Block row space="around" width={200}>
                <Text muted > {getAge(state.params.birth_date)} ans</Text>
                <Text muted> {state.params.city}</Text>
              </Block>
              <Block row style={styles.buttonsProfile}>
                <Button onPress={() => this.props.navigation.navigate('Messages',state.params)} style={styles.buttonProfileMessage}  iconColor={theme.COLORS.SECONDARY}	onlyIcon iconSize={20} icon="message-circle" iconFamily="feather" flex={2}></Button>
                <Button onPress={()=>{Linking.openURL(`tel:${state.params.phone}`)}} style={styles.buttonProfilePhone}  iconColor={theme.COLORS.DEFAULT}	onlyIcon iconSize={20} icon="phone" iconFamily="feather" flex={2}></Button>
              </Block>      
            </Block>
          </Block>
          <Block flex={0.9} space="evenly" center fluid style={styles.titlesBlock}>
              <Text style={styles.textTitle} h3>{state.params.title}</Text>
              <Text style={styles.textTitle} h5 color={theme.COLORS.SECONDARY}>{state.params.type}</Text>
          </Block>
          
          <Block flex={2.5} style={styles.contentBlock}>
            <ScrollView >
              <Block row style={styles.itemBlock}>
                <Icon  size={25} name="calendar" family="feather" color={theme.COLORS.MUTED}/>
                  <Text  style={styles.textContent}>{reformatDate(state.params.date_start)}</Text>
              </Block>
              <Block row style={styles.itemBlock}>
                <Icon size={25} name="clock" family="feather" color={theme.COLORS.MUTED}/>
                <Text style={styles.textContent}>{reformatTime(state.params.time_start)} - {reformatTime(state.params.time_end)}</Text>
              </Block>
              <Block row style={styles.itemBlock}>
                <Icon size={25} name="dollar-sign" family="feather" color={theme.COLORS.MUTED}/>
                <Text style={styles.textContent}>{getPrice(state.params.time_start,state.params.time_end,state.params.price)}€</Text>
              </Block>
              <Block row style={styles.itemBlock}>
                <Icon size={25} name="map-pin" family="feather" color={theme.COLORS.MUTED}/>
                <Text style={styles.textContent}>{state.params.place}</Text>
              </Block>
              <Block row style={styles.itemBlock}>
                <Icon size={25} name="tag" family="feather" color={theme.COLORS.MUTED}/>
                  <Text style={styles.textContent}>{state.params.description}</Text>
              </Block>
            </ScrollView>
          </Block>
          
          <Block flex={0.9} space="around">
            <Block row space="evenly">
                <Button style={styles.buttonDelete} onPress={this.showAlert.bind(this,0)} >Annuler</Button>
                <Button style={styles.buttonFree} onPress={this.showAlert.bind(this,1)} >Libérer</Button>
           
            </Block>
            <Block center>
                <Button style={styles.buttonAccept} onPress={this.showAlert.bind(this,2)}>Terminer</Button>

            </Block>
          </Block>

          <AwesomeAlert
            show={this.state.showAlert}
            showProgress={false}
            title={this.state.typeAlert == 1 ?"Enlever ce travailleur" :this.state.typeAlert == 2 ?"Terminer ce travail ":"Annuler ce travail"}
            message="Etes vous sûr?"
            closeOnTouchOutside={true}
            closeOnHardwareBackPress={false}
            showCancelButton={true}
            showConfirmButton={true}
            cancelText="Non"
            confirmText={"Oui, bien sûr"}
            confirmButtonColor={theme.COLORS.SECONDARY}
            onCancelPressed={() => {
              this.hideAlert();
            }}
            onConfirmPressed={() => {
              if(this.state.typeAlert == 1){
                this.free();
              }
              else if(this.state.typeAlert == 2){
                  this.finish();
              }
              else{
                this.cancel();
              }
              
              this.hideAlert();
              this.props.navigation.goBack();
            }}
          />


          
        </Block>
    )
  }
}

const styles = StyleSheet.create({
  test:{
    backgroundColor:'red',
    
  },
  main_container: {
    flex:1,
    backgroundColor:theme.COLORS.BACKGROUND
    
  },
  headerBlock:{
    flexDirection:"row",
    backgroundColor:theme.COLORS.DEFAULT,
    shadowColor: "#000",
    shadowOffset: {
        width: 0,
        height: 1,
    },
    shadowOpacity: 0.20,
    shadowRadius: 1.41,

    elevation: 5,
  },
  profile:{
    borderRadius:200,
    height:100,
    width:100
  },
  profileBlock:{
    marginTop:15,
    marginLeft:15

  },
  infoprofileBlock:{
    paddingTop:15
  },
  
  buttonsProfile:{
    width:200,
    paddingTop:10,
    justifyContent:"space-around",
  },
  buttonProfileMessage:{
    width:80,
    height:35,
    backgroundColor: theme.COLORS.DEFAULT,
    borderBottomColor:theme.COLORS.MUTED,
    
  },
  buttonProfilePhone:{
    width:80,
    height:35,
    backgroundColor: theme.COLORS.SECONDARY
  },

  titlesBlock:{
    width:Dimensions.get("window").width,
    marginTop:10
    
  },
  textTitle:{
    textAlign:"center"
  },

  contentBlock:{
    width:Dimensions.get("window").width,
    marginRight:30,
  },
  itemBlock:{
    marginTop:15,
    marginLeft:25
  },
  textContent:{
    fontSize:18,
    marginLeft:15
  },
  progressionBlock:{
    backgroundColor:theme.COLORS.DEFAULT,
    width:80,
    height:30,
    marginLeft:80,
    borderRadius:5,
  },
  progressionText:{
    color:theme.COLORS.ERROR
  },
  buttonDelete:{
    backgroundColor:theme.COLORS.MUTED,
    width:100,
    height:35,
    marginBottom:10
  },
  buttonAccept:{
    backgroundColor:theme.COLORS.SECONDARY,
    width:Dimensions.get("window").width -55,
    height:35,
    marginBottom:10
  },
  buttonFree:{
    backgroundColor:theme.COLORS.GITHUB,
    width:170,
    height:35,
    marginBottom:10
  }
})

const mapStateToProps = (state) =>{
  return {
      account: state.account.account
  }
}


export default connect(mapStateToProps)(DetailsWorkTakeReq)