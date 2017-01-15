var stats = {
    type: "GROUP",
name: "Global Information",
path: "",
pathFormatted: "group_missing-name-b06d1",
stats: {
    "name": "Global Information",
    "numberOfRequests": {
        "total": "40200",
        "ok": "30167",
        "ko": "10033"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "10",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "20224",
        "ok": "20224",
        "ko": "9615"
    },
    "meanResponseTime": {
        "total": "3720",
        "ok": "4666",
        "ko": "876"
    },
    "standardDeviation": {
        "total": "3795",
        "ok": "3728",
        "ko": "2265"
    },
    "percentiles1": {
        "total": "2410",
        "ok": "4022",
        "ko": "5"
    },
    "percentiles2": {
        "total": "7699",
        "ok": "8430",
        "ko": "18"
    },
    "percentiles3": {
        "total": "10013",
        "ok": "10228",
        "ko": "7331"
    },
    "percentiles4": {
        "total": "10971",
        "ok": "11090",
        "ko": "8403"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 5536,
        "percentage": 14
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 336,
        "percentage": 1
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 24295,
        "percentage": 60
    },
    "group4": {
        "name": "failed",
        "count": 10033,
        "percentage": 25
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "187.85",
        "ok": "140.967",
        "ko": "46.883"
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
        "ok": "15092",
        "ko": "5008"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "10",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "12266",
        "ok": "12266",
        "ko": "8746"
    },
    "meanResponseTime": {
        "total": "3417",
        "ok": "4351",
        "ko": "603"
    },
    "standardDeviation": {
        "total": "3640",
        "ok": "3601",
        "ko": "1882"
    },
    "percentiles1": {
        "total": "1915",
        "ok": "3674",
        "ko": "5"
    },
    "percentiles2": {
        "total": "7255",
        "ok": "8115",
        "ko": "17"
    },
    "percentiles3": {
        "total": "9543",
        "ok": "9743",
        "ko": "6701"
    },
    "percentiles4": {
        "total": "10414",
        "ok": "10536",
        "ko": "7724"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 2975,
        "percentage": 15
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 191,
        "percentage": 1
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 11926,
        "percentage": 59
    },
    "group4": {
        "name": "failed",
        "count": 5008,
        "percentage": 25
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "93.925",
        "ok": "70.523",
        "ko": "23.402"
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
        "ok": "15075",
        "ko": "5025"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "17",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "20224",
        "ok": "20224",
        "ko": "9615"
    },
    "meanResponseTime": {
        "total": "4023",
        "ok": "4982",
        "ko": "1147"
    },
    "standardDeviation": {
        "total": "3921",
        "ok": "3825",
        "ko": "2562"
    },
    "percentiles1": {
        "total": "2889",
        "ok": "4441",
        "ko": "5"
    },
    "percentiles2": {
        "total": "8112",
        "ok": "8849",
        "ko": "20"
    },
    "percentiles3": {
        "total": "10358",
        "ok": "10555",
        "ko": "7840"
    },
    "percentiles4": {
        "total": "11208",
        "ok": "11342",
        "ko": "8703"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 2561,
        "percentage": 13
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 145,
        "percentage": 1
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 12369,
        "percentage": 62
    },
    "group4": {
        "name": "failed",
        "count": 5025,
        "percentage": 25
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "93.925",
        "ok": "70.444",
        "ko": "23.481"
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
