var stats = {
    type: "GROUP",
name: "Global Information",
path: "",
pathFormatted: "group_missing-name-b06d1",
stats: {
    "name": "Global Information",
    "numberOfRequests": {
        "total": "2550",
        "ok": "2550",
        "ko": "0"
    },
    "minResponseTime": {
        "total": "27",
        "ok": "27",
        "ko": "-"
    },
    "maxResponseTime": {
        "total": "19261",
        "ok": "19261",
        "ko": "-"
    },
    "meanResponseTime": {
        "total": "8972",
        "ok": "8972",
        "ko": "-"
    },
    "standardDeviation": {
        "total": "6328",
        "ok": "6328",
        "ko": "-"
    },
    "percentiles1": {
        "total": "9286",
        "ok": "9286",
        "ko": "-"
    },
    "percentiles2": {
        "total": "15296",
        "ok": "15296",
        "ko": "-"
    },
    "percentiles3": {
        "total": "17627",
        "ok": "17627",
        "ko": "-"
    },
    "percentiles4": {
        "total": "18582",
        "ok": "18582",
        "ko": "-"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 265,
        "percentage": 10
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 29,
        "percentage": 1
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 2256,
        "percentage": 88
    },
    "group4": {
        "name": "failed",
        "count": 0,
        "percentage": 0
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "30",
        "ok": "30",
        "ko": "-"
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
        "total": "1275",
        "ok": "1275",
        "ko": "0"
    },
    "minResponseTime": {
        "total": "27",
        "ok": "27",
        "ko": "-"
    },
    "maxResponseTime": {
        "total": "18887",
        "ok": "18887",
        "ko": "-"
    },
    "meanResponseTime": {
        "total": "7640",
        "ok": "7640",
        "ko": "-"
    },
    "standardDeviation": {
        "total": "5776",
        "ok": "5776",
        "ko": "-"
    },
    "percentiles1": {
        "total": "6693",
        "ok": "6693",
        "ko": "-"
    },
    "percentiles2": {
        "total": "12969",
        "ok": "12969",
        "ko": "-"
    },
    "percentiles3": {
        "total": "17076",
        "ok": "17076",
        "ko": "-"
    },
    "percentiles4": {
        "total": "18021",
        "ok": "18021",
        "ko": "-"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 151,
        "percentage": 12
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 13,
        "percentage": 1
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 1111,
        "percentage": 87
    },
    "group4": {
        "name": "failed",
        "count": 0,
        "percentage": 0
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "15",
        "ok": "15",
        "ko": "-"
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
        "total": "1275",
        "ok": "1275",
        "ko": "0"
    },
    "minResponseTime": {
        "total": "39",
        "ok": "39",
        "ko": "-"
    },
    "maxResponseTime": {
        "total": "19261",
        "ok": "19261",
        "ko": "-"
    },
    "meanResponseTime": {
        "total": "10304",
        "ok": "10304",
        "ko": "-"
    },
    "standardDeviation": {
        "total": "6571",
        "ok": "6571",
        "ko": "-"
    },
    "percentiles1": {
        "total": "12765",
        "ok": "12765",
        "ko": "-"
    },
    "percentiles2": {
        "total": "16201",
        "ok": "16201",
        "ko": "-"
    },
    "percentiles3": {
        "total": "17930",
        "ok": "17930",
        "ko": "-"
    },
    "percentiles4": {
        "total": "18683",
        "ok": "18683",
        "ko": "-"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 114,
        "percentage": 9
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 16,
        "percentage": 1
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 1145,
        "percentage": 90
    },
    "group4": {
        "name": "failed",
        "count": 0,
        "percentage": 0
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "15",
        "ok": "15",
        "ko": "-"
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
