var defaultCoffee = 26;
var defaultWater = 350;
var bloomTime = 90;
var bloomWater = 50;
var brewTime = 270;
var brewWater = 300;
String.prototype.format = function () {
    var args = arguments;
    this.unkeyed_index = 0;
    return this.replace(/\{(\w*)\}/g, function (match, key) {
        if (key === '') {
            key = this.unkeyed_index;
            this.unkeyed_index++
        }
        if (key == +key) {
            return args[key] !== 'undefined' ? args[key] : match;
        }
        else {
            for (var i = 0; i < args.length; i++) {
                if (typeof args[i] === 'object' && typeof args[i][key] !== 'undefined') {
                    return args[i][key];
                }
            }
            return match;
        }
    }.bind(this));
};
var bloomMinutes = Math.floor(bloomTime / 60);
var brewMinutes = Math.floor(brewTime / 60);
var bloomSeconds = bloomTime % 60;
var brewSeconds = brewTime % 60;
var countdownBloom = function () {
    bloomSeconds -= 1;
    el.textContent = "{}:{}".format(bloomMinutes, bloomSeconds);
    if (bloomSeconds < 10) {
        el.textContent = "{}:0{}".format(bloomMinutes, bloomSeconds);
    }
    if (bloomSeconds == 0) {
        bloomMinutes -= 1;
        bloomSeconds += 60;
    } else if (bloomMinutes <= 0 && bloomSeconds <= 1) {
        el.textContent = "Press Done button to Continue";
        $('#done').show();
    } else {
        setTimeout(countdownBloom, 1000); 
    }

}
var countdownBrew = function () {
    brewSeconds -= 1;
    el.textContent = "{}:{}".format(brewMinutes, brewSeconds);
    if (brewSeconds < 10) {
        el.textContent = "{}:0{}".format(brewMinutes, brewSeconds);
    }
    if (brewSeconds == 0) {
        brewMinutes -= 1;
        brewSeconds += brewSeconds + 60;
    } else if (brewSeconds <= 0 && brewMinutes <= 1) {
        el.textContent = "Press Done button to Continue";
        $('#done').show();
    } else {
        setTimeout(countdownBrew, 1000); 
    }
}