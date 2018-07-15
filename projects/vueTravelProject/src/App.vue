<template>
  <div id="app">
  	<!-- 把内容保存到内存中不需要每次切换路由就使用ajax -->
  	<keep-alive	exclude="Detail">	
    	<router-view/>
  	</keep-alive>
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>

<style>

</style>
