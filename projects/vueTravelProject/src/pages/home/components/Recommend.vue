<template>
	<div>
		<div class="recommend-title">热销推荐</div>
	<ul>
		<router-link tag='Li'
		 class="item border-bottom"
		  v-for="item of recommend" 
		  :key="item.id"
		  :to="'/Detail/' + item.id"
		  >
			<div class="item-img-wraper">
				<img class="item-img" :src="item.imgUrl" />
			</div>
			<div class="item-info">
				<p class="item-title">{{item.title}}</p>
				<p class="item-desc">{{item.desc}}</p>
				<button class="item-button">查看详情</button>
			</div>
		</router-link>
	</ul>
	</div>
</template>
<script>
	export default {
		name:'HomeRecommend',
		props:{
			recommend:Array
		},
		data () {
			return {
				
			}
		}
	}
</script>
<style lang="stylus" scoped>
@import '~styles/mixins.styl'
	.recommend-title
		margin-top:.1rem
		line-height:.8rem
		background:#eee
		text-indent:.2rem
		ellipsis()
	.item
		display:flex
		height:1.9rem
		overflow:hidden
		.item-img
			width:1.7rem
			height:1.7rem
			padding:.1rem
		.item-info
			flex:1
			padding:.1rem
			min-width:0	
			.item-title
				line-height:.54rem
				font-size:.32rem
			.item-desc
				line-height:.4rem
				color:#ccc
				ellipsis()
			.item-button
				margin-top:.2rem
				line-height:.44rem
				background:#ff9300
				padding:0 .1rem
				border-radius:.06rem
				color:#fff		
				
</style>