<template>
	<div>
		<div class="recommend-title">周末去哪儿</div>
	<ul>
		<li class="item border-bottom" v-for="item of weekend" :key="item.id">
			<div class="item-img-wraper">
				<img class="item-img" :src="item.imgUrl" />
			</div>
			<div class="item-info">
				<p class="item-title">{{item.title}}</p>
				<p class="item-desc">{{item.desc}}</p>
			</div>
		</li>
	</ul>
	</div>
</template>
<script>
	export default {
		name:'HomeWeekend',
		props:{
			weekend:Array
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
		// margin-top:.1rem
		line-height:.8rem
		background:#eee
		text-indent:.2rem
		ellipsis()
	.item-img-wraper
		overflow:hidden
		height:0
		padding-bottom:33.5%	
		.item-img
			width:100%
	.item-info
		padding:.1rem
		.item-title
			line-height:.54rem
			font-size:.32rem
		.item-desc
			line-height:.4rem
			color:#ccc
			ellipsis()
			
</style>