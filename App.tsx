import React, { useEffect } from 'react';
import { NavigationContainer } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import { GOOGLE_IOS_CLIENT_ID, GOOGLE_WEB_CLIENT_ID } from '@env';
import './global.css';

import SignInScreen from '@screens/SignInScreen';
import DashboardScreen from '@screens/DashboardScreen';
import ManualSignInScreen from '@screens/ManualSignInScreen';
import CreateAccountScreen from '@screens/CreateAccountScreen';
import SuppliersScreen from '@screens/SuppliersScreen';
import { GoogleSignin } from '@react-native-google-signin/google-signin';

export type RootStackParamList = {
  SignIn: undefined;
  Dashboard: undefined;
  ManualSignIn: undefined;
  CreateAccount: undefined;
  Suppliers: undefined;
};

const Stack = createNativeStackNavigator<RootStackParamList>();

const screenOptions = {
  headerShown: false,
  contentStyle: {
    backgroundColor: '#FFFFFF',
  },
};

console.log(GOOGLE_IOS_CLIENT_ID, GOOGLE_WEB_CLIENT_ID);

const App = () => {
  useEffect(() => {
    GoogleSignin.configure({
      iosClientId: GOOGLE_IOS_CLIENT_ID,
      webClientId: GOOGLE_WEB_CLIENT_ID,
      offlineAccess: true,
    });

  }, []);

  return (
    <NavigationContainer>
      <Stack.Navigator initialRouteName="SignIn" screenOptions={screenOptions}>
        <Stack.Screen name="SignIn" component={SignInScreen} />
        <Stack.Screen name="ManualSignIn" component={ManualSignInScreen} />
        <Stack.Screen name="CreateAccount" component={CreateAccountScreen} />
        <Stack.Screen name="Dashboard" component={DashboardScreen} />
        <Stack.Screen name="Suppliers" component={SuppliersScreen} />
      </Stack.Navigator>
    </NavigationContainer>
  );
};

export default App; 