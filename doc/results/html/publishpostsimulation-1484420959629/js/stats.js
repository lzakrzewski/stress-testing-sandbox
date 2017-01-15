var stats = {
    type: "GROUP",
name: "Global Information",
path: "",
pathFormatted: "group_missing-name-b06d1",
stats: {
    "name": "Global Information",
    "numberOfRequests": {
        "total": "15300",
        "ok": "3016",
        "ko": "12284"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "10",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "60023",
        "ok": "59991",
        "ko": "60023"
    },
    "meanResponseTime": {
        "total": "12789",
        "ok": "16826",
        "ko": "11798"
    },
    "standardDeviation": {
        "total": "23006",
        "ok": "18673",
        "ko": "23846"
    },
    "percentiles1": {
        "total": "2",
        "ok": "8405",
        "ko": "2"
    },
    "percentiles2": {
        "total": "10958",
        "ok": "30565",
        "ko": "4"
    },
    "percentiles3": {
        "total": "60002",
        "ok": "53834",
        "ko": "60002"
    },
    "percentiles4": {
        "total": "60004",
        "ok": "58863",
        "ko": "60004"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 757,
        "percentage": 5
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 38,
        "percentage": 0
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 2221,
        "percentage": 15
    },
    "group4": {
        "name": "failed",
        "count": 12284,
        "percentage": 80
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "36.256",
        "ok": "7.147",
        "ko": "29.109"
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
        "total": "7650",
        "ok": "1812",
        "ko": "5838"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "10",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "60023",
        "ok": "59991",
        "ko": "60023"
    },
    "meanResponseTime": {
        "total": "11323",
        "ok": "18856",
        "ko": "8985"
    },
    "standardDeviation": {
        "total": "21296",
        "ok": "19074",
        "ko": "21407"
    },
    "percentiles1": {
        "total": "2",
        "ok": "12694",
        "ko": "2"
    },
    "percentiles2": {
        "total": "6892",
        "ok": "33835",
        "ko": "3"
    },
    "percentiles3": {
        "total": "60002",
        "ok": "55044",
        "ko": "60002"
    },
    "percentiles4": {
        "total": "60003",
        "ok": "59160",
        "ko": "60004"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 394,
        "percentage": 5
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 26,
        "percentage": 0
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 1392,
        "percentage": 18
    },
    "group4": {
        "name": "failed",
        "count": 5838,
        "percentage": 76
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "18.128",
        "ok": "4.294",
        "ko": "13.834"
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
        "total": "7650",
        "ok": "1204",
        "ko": "6446"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "21",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "60020",
        "ok": "59843",
        "ko": "60020"
    },
    "meanResponseTime": {
        "total": "14255",
        "ok": "13772",
        "ko": "14345"
    },
    "standardDeviation": {
        "total": "24509",
        "ok": "17616",
        "ko": "25591"
    },
    "percentiles1": {
        "total": "2",
        "ok": "4147",
        "ko": "1"
    },
    "percentiles2": {
        "total": "18376",
        "ok": "24269",
        "ko": "7"
    },
    "percentiles3": {
        "total": "60002",
        "ok": "52306",
        "ko": "60003"
    },
    "percentiles4": {
        "total": "60004",
        "ok": "58580",
        "ko": "60005"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 363,
        "percentage": 5
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 12,
        "percentage": 0
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 829,
        "percentage": 11
    },
    "group4": {
        "name": "failed",
        "count": 6446,
        "percentage": 84
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "18.128",
        "ok": "2.853",
        "ko": "15.275"
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
