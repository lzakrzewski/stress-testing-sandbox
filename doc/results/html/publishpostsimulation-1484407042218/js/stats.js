var stats = {
    type: "GROUP",
name: "Global Information",
path: "",
pathFormatted: "group_missing-name-b06d1",
stats: {
    "name": "Global Information",
    "numberOfRequests": {
        "total": "50000",
        "ok": "21930",
        "ko": "28070"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "32",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "60014",
        "ok": "59915",
        "ko": "60014"
    },
    "meanResponseTime": {
        "total": "7513",
        "ok": "12961",
        "ko": "3258"
    },
    "standardDeviation": {
        "total": "9355",
        "ok": "9528",
        "ko": "6607"
    },
    "percentiles1": {
        "total": "3976",
        "ok": "11195",
        "ko": "0"
    },
    "percentiles2": {
        "total": "12487",
        "ok": "18193",
        "ko": "3735"
    },
    "percentiles3": {
        "total": "25577",
        "ok": "30857",
        "ko": "17370"
    },
    "percentiles4": {
        "total": "39750",
        "ok": "44916",
        "ko": "28324"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 167,
        "percentage": 0
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 45,
        "percentage": 0
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 21718,
        "percentage": 43
    },
    "group4": {
        "name": "failed",
        "count": 28070,
        "percentage": 56
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "193.798",
        "ok": "85",
        "ko": "108.798"
    }
},
contents: {
"req_wall-94e8a": {
        type: "REQUEST",
        name: "Wall",
path: "Wall",
pathFormatted: "req_wall-94e8a",
stats: {
    "name": "Wall",
    "numberOfRequests": {
        "total": "25000",
        "ok": "10590",
        "ko": "14410"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "32",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "59848",
        "ok": "59848",
        "ko": "59040"
    },
    "meanResponseTime": {
        "total": "4208",
        "ok": "7180",
        "ko": "2023"
    },
    "standardDeviation": {
        "total": "5294",
        "ok": "5633",
        "ko": "3746"
    },
    "percentiles1": {
        "total": "2649",
        "ok": "6086",
        "ko": "0"
    },
    "percentiles2": {
        "total": "6742",
        "ok": "9608",
        "ko": "3053"
    },
    "percentiles3": {
        "total": "13285",
        "ok": "16765",
        "ko": "9377"
    },
    "percentiles4": {
        "total": "22334",
        "ok": "31026",
        "ko": "14704"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 127,
        "percentage": 1
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 43,
        "percentage": 0
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 10420,
        "percentage": 42
    },
    "group4": {
        "name": "failed",
        "count": 14410,
        "percentage": 58
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "96.899",
        "ok": "41.047",
        "ko": "55.853"
    }
}
    },"req_publishpost-28274": {
        type: "REQUEST",
        name: "PublishPost",
path: "PublishPost",
pathFormatted: "req_publishpost-28274",
stats: {
    "name": "PublishPost",
    "numberOfRequests": {
        "total": "25000",
        "ok": "11340",
        "ko": "13660"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "53",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "60014",
        "ok": "59915",
        "ko": "60014"
    },
    "meanResponseTime": {
        "total": "10819",
        "ok": "18359",
        "ko": "4560"
    },
    "standardDeviation": {
        "total": "11186",
        "ok": "9251",
        "ko": "8461"
    },
    "percentiles1": {
        "total": "10409",
        "ok": "17244",
        "ko": "0"
    },
    "percentiles2": {
        "total": "18163",
        "ok": "22769",
        "ko": "8138"
    },
    "percentiles3": {
        "total": "30322",
        "ok": "35851",
        "ko": "21700"
    },
    "percentiles4": {
        "total": "45374",
        "ok": "48208",
        "ko": "33491"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 40,
        "percentage": 0
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 2,
        "percentage": 0
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 11298,
        "percentage": 45
    },
    "group4": {
        "name": "failed",
        "count": 13660,
        "percentage": 55
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "96.899",
        "ok": "43.953",
        "ko": "52.946"
    }
}
    }
}

}

function fillStats(stat){
    $("#numberOfRequests").append(stat.numberOfRequests.total);
    $("#numberOfRequestsOK").append(stat.numberOfRequests.ok);
    $("#numberOfRequestsKO").append(stat.numberOfRequests.ko);

    $("#minResponseTime").append(stat.minResponseTime.total);
    $("#minResponseTimeOK").append(stat.minResponseTime.ok);
    $("#minResponseTimeKO").append(stat.minResponseTime.ko);

    $("#maxResponseTime").append(stat.maxResponseTime.total);
    $("#maxResponseTimeOK").append(stat.maxResponseTime.ok);
    $("#maxResponseTimeKO").append(stat.maxResponseTime.ko);

    $("#meanResponseTime").append(stat.meanResponseTime.total);
    $("#meanResponseTimeOK").append(stat.meanResponseTime.ok);
    $("#meanResponseTimeKO").append(stat.meanResponseTime.ko);

    $("#standardDeviation").append(stat.standardDeviation.total);
    $("#standardDeviationOK").append(stat.standardDeviation.ok);
    $("#standardDeviationKO").append(stat.standardDeviation.ko);

    $("#percentiles1").append(stat.percentiles1.total);
    $("#percentiles1OK").append(stat.percentiles1.ok);
    $("#percentiles1KO").append(stat.percentiles1.ko);

    $("#percentiles2").append(stat.percentiles2.total);
    $("#percentiles2OK").append(stat.percentiles2.ok);
    $("#percentiles2KO").append(stat.percentiles2.ko);

    $("#percentiles3").append(stat.percentiles3.total);
    $("#percentiles3OK").append(stat.percentiles3.ok);
    $("#percentiles3KO").append(stat.percentiles3.ko);

    $("#percentiles4").append(stat.percentiles4.total);
    $("#percentiles4OK").append(stat.percentiles4.ok);
    $("#percentiles4KO").append(stat.percentiles4.ko);

    $("#meanNumberOfRequestsPerSecond").append(stat.meanNumberOfRequestsPerSecond.total);
    $("#meanNumberOfRequestsPerSecondOK").append(stat.meanNumberOfRequestsPerSecond.ok);
    $("#meanNumberOfRequestsPerSecondKO").append(stat.meanNumberOfRequestsPerSecond.ko);
}
