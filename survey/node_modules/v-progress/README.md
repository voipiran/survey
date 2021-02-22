# v-progress

> progress ui component for vue2，copy from rc-progress, so props can reference [rc-progress](https://github.com/fis-components/rc-progress)

由于个人需要，没有找到合适的组件。于是仿照了react-component的rc-progress写了这个vue的组件，prop都可以参照rc-progress的API

## Use
 
**install**

`npm install v-progress --save`

## Example
```
<template>
    <v-line :percent="percent" stroke-width="4" :strokeColor="color"/>
    <v-circle :percent="percent" stroke-width="6" stroke-linecap="round" :strokeColor="color"/>
</template>
<script>
import {VCircle, VLine} from 'v-progress'

export default {
  components: {
    VCircle,
    VLine
  },
  data() {
    return {
      percent: 30,
      color: '#3FC7FA'
    }
  }
}
</script>
```
