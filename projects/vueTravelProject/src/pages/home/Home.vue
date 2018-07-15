<template>
	<div>
		<home-header></home-header>
		<home-swiper :swiper="swiper"></home-swiper>
		<home-icons :icon="icon"></home-icons>
		<home-recommend :recommend="recommend"></home-recommend>
		<home-weekend :weekend="weekend"></home-weekend>
	</div>
</template>
<script>
import HomeHeader from './components/header'
import HomeSwiper from './components/Swiper'
import HomeIcons from './components/Icons'
import HomeRecommend from './components/Recommend'
import HomeWeekend from './components/weekend'
import axios from 'axios'
import { mapState } from 'vuex'
export default {
  name: 'Home',
  components: {
    HomeHeader,
    HomeSwiper,
    HomeIcons,
    HomeRecommend,
    HomeWeekend
  },
  data () {
  	return {
  		swiper:[],
  		icon:[],
  		recommend:[],
  		weekend:[],
      lastCity:''
  	}
  },
  mounted () {
    this.lastCity = this.city
  	this.getHomeInfo()
  },
  activated () {
    if (this.lastCity !== this.city) {
      this.lastCity = this.city
      this.getHomeInfo()
    }
  },
  computed: {
    ...mapState(['city'])
  },
  methods:{
  	getHomeInfo () {
  		axios.get('/api/index.json?=' + this.city)
      .then(this.getHomeInfoSucc)
  	},
  	getHomeInfoSucc (res) {
  		res = res.data;
  		if (res.ret && res.data) {
  			const data = res.data
  			this.swiper = data.swiperList
  			this.icon = data.iconList
  			this.weekend = data.weekendList
  			this.recommend = data.recommendList
  		}
  	}
  }
}
</script>
<style lang="stylus" scoped>

</style>
