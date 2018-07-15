<template>
	<div>
		<router-link
		 v-show="showAbs"
		 tag="div" 
		 to="/"
		  class="header-abs">
			<i class="iconfont header-abs-icon">&#xe624;</i>
		</router-link>
		<div 
		class="header-fixed"
		 v-show="!showAbs"
		 :style="opacityStyle"
		 >
			景点详情
			<router-link to="/">
				<div class="iconfont header-fixed-back">
					&#xe624;
				</div>
			</router-link>
		</div>
	</div>
</template>
<script>
	export default {
		name: 'DetailHeader',
		data () {
			return {
				showAbs:true,
				opacityStyle:{
					opacity:0
				}
			}
		},
		activated () {
			window.addEventListener('scroll',this.handleScroll)
		},
		deactivated () {
			window.removeEventListener('scroll',this.handleScroll)
		},
		methods:{
			handleScroll () {
				const top = document.documentElement.scrollTop;
				if (top > 60) {
					let opacity = top / 140
					opacity = opacity > 1 ? 1 : opacity
					this.opacityStyle = {opacity}
					this.showAbs = false
				} else {
					this.showAbs = true
				}
			}
		}
	}
</script>
<style lang="stylus" scoped>
@import '~styles/varibles.styl'
		.header-abs
			position:absolute
			top:.2rem
			left:.2rem
			width:.8rem
			height:.8rem
			line-height:.8rem
			text-align:center
			border-radius:.4rem
			background:rgba(0,0,0,.8)
			.header-abs-icon
				color:#fff
				font-size:.4rem
		.header-fixed
			z-index:2
			position:fixed
			top:0
			left:0
			right:0
			height:$headerHeight
			line-height:$headerHeight
			text-align:center
			background:$bgColor
			color:#fff
			font-size:.32rem
			.header-fixed-back
				position:absolute
				width:.64rem
				top:0
				left:0
				text-align:center
				font-size:.4rem
				color:#fff		
</style>