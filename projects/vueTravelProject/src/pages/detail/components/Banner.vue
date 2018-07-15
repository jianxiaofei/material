<template>
	<div>
		<div class="banner" @click="handleBannerClick">
		<img class="banner-img" :src="bannerImg" />
		<div class="banner-info">
			<div class="banner-title">{{this.sightName}}</div>
			<div class="banner-number">
				<i class="banner-icon iconfont arrow-icon">&#xe63f;</i>
				{{this.bannerImgs.length}}
			</div>
		</div>
	</div>
	<fade-animation>
		<common-gallary 
		:imgs="bannerImgs" 
		v-show="showGallary"
		@close="handleClose"
		></common-gallary>
	</fade-animation>	
	</div>
</template>
<script>
	import CommonGallary from 'common/gallary/Gallary'
	import FadeAnimation from 'common/fade/FadeAnimation'
	export default {
		name: 'Banner',
		props:{
			sightName: String,
			bannerImg:String,
			bannerImgs: Array
		},
		components:{
			CommonGallary,
			FadeAnimation
		},
		data () {
			return { 
				showGallary:false
			}
		},
		methods:{
			handleBannerClick () {
				this.showGallary = true
			},
			handleClose () {
				this.showGallary = false	
			}
		}
	}
</script>
<style lang="stylus" scoped>
	.banner
		position:relative
		overflow:hidden
		height:0
		padding-bottom:55%
		.banner-img
			width:100%
		.banner-info
			display:flex
			position:absolute
			left:0
			right:0
			bottom:0
			line-height:.6rem
			color:#fff
			// 渐变效果
			background-image:linear-gradient(top, rgba(0,0,0,0),rgba(0,0,0,8))
			.banner-title
				font-size:.3rem
				padding:0 .2rem
				flex:1
			.banner-number
				margin-top:.2rem
				padding:0 .4rem
				height:.32rem
				line-height:.32rem
				font-size:.3rem
				border-radius:.2rem
				background:rgba(0,0,0,.3)
				.banner-icon
					font-size:.3rem	
</style>