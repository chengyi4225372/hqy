import React from 'react'
const ThemeContext  = React.createContext('light');
const Button = (props) =>{
  return (
    <button style={{backgroundColor:props.theme}}>THEME</button>
  )
}
const ThemeButton = (props) =>{
  return(
    <ThemeContext.Consumer>
      {theme => <button {...props} theme={theme}/>}
    </ThemeContext.Consumer>
  )
}
const Toolbar = (props) =>{
  return(
    <div>
      <ThemeButton/>
    </div>
  )
}
class Ant extends React.Component{
  render() {
    return (
      <ThemeContext.Provider>
        <Toolbar/>
      </ThemeContext.Provider>
    );
  }
}

export default Ant;
