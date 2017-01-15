var stats = {
    type: "GROUP",
name: "Global Information",
path: "",
pathFormatted: "group_missing-name-b06d1",
stats: {
    "name": "Global Information",
    "numberOfRequests": {
        "total": "40200",
        "ok": "16729",
        "ko": "23471"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "14",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "60057",
        "ok": "59911",
        "ko": "60057"
    },
    "meanResponseTime": {
        "total": "6681",
        "ok": "12158",
        "ko": "2777"
    },
    "standardDeviation": {
        "total": "9329",
        "ok": "10073",
        "ko": "6333"
    },
    "percentiles1": {
        "total": "2178",
        "ok": "9619",
        "ko": "0"
    },
    "percentiles2": {
        "total": "10676",
        "ok": "17832",
        "ko": "1682"
    },
    "percentiles3": {
        "total": "25619",
        "ok": "31550",
        "ko": "17337"
    },
    "percentiles4": {
        "total": "38877",
        "ok": "45584",
        "ko": "27898"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 614,
        "percentage": 2
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 80,
        "percentage": 0
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 16035,
        "percentage": 40
    },
    "group4": {
        "name": "failed",
        "count": 23471,
        "percentage": 58
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "156.42",
        "ok": "65.093",
        "ko": "91.327"
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
        "total": "20100",
        "ok": "8102",
        "ko": "11998"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "14",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "59604",
        "ok": "59019",
        "ko": "59604"
    },
    "meanResponseTime": {
        "total": "3754",
        "ok": "6726",
        "ko": "1747"
    },
    "standardDeviation": {
        "total": "5285",
        "ok": "5936",
        "ko": "3606"
    },
    "percentiles1": {
        "total": "1609",
        "ok": "5505",
        "ko": "0"
    },
    "percentiles2": {
        "total": "6169",
        "ok": "9397",
        "ko": "2006"
    },
    "percentiles3": {
        "total": "13128",
        "ok": "16600",
        "ko": "9024"
    },
    "percentiles4": {
        "total": "21947",
        "ok": "30179",
        "ko": "14444"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 378,
        "percentage": 2
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 39,
        "percentage": 0
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 7685,
        "percentage": 38
    },
    "group4": {
        "name": "failed",
        "count": 11998,
        "percentage": 60
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "78.21",
        "ok": "31.525",
        "ko": "46.685"
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
        "total": "20100",
        "ok": "8627",
        "ko": "11473"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "51",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "60057",
        "ok": "59911",
        "ko": "60057"
    },
    "meanResponseTime": {
        "total": "9608",
        "ok": "17260",
        "ko": "3855"
    },
    "standardDeviation": {
        "total": "11357",
        "ok": "10484",
        "ko": "8135"
    },
    "percentiles1": {
        "total": "5124",
        "ok": "16769",
        "ko": "0"
    },
    "percentiles2": {
        "total": "17584",
        "ok": "22963",
        "ko": "4"
    },
    "percentiles3": {
        "total": "30684",
        "ok": "36012",
        "ko": "21976"
    },
    "percentiles4": {
        "total": "44711",
        "ok": "49224",
        "ko": "32920"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 236,
        "percentage": 1
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 41,
        "percentage": 0
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 8350,
        "percentage": 42
    },
    "group4": {
        "name": "failed",
        "count": 11473,
        "percentage": 57
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "78.21",
        "ok": "33.568",
        "ko": "44.642"
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
