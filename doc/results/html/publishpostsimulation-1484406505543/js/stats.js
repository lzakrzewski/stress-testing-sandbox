var stats = {
    type: "GROUP",
name: "Global Information",
path: "",
pathFormatted: "group_missing-name-b06d1",
stats: {
    "name": "Global Information",
    "numberOfRequests": {
        "total": "40200",
        "ok": "15432",
        "ko": "24768"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "29",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "60053",
        "ok": "59939",
        "ko": "60053"
    },
    "meanResponseTime": {
        "total": "6251",
        "ok": "12557",
        "ko": "2321"
    },
    "standardDeviation": {
        "total": "10593",
        "ok": "12527",
        "ko": "6642"
    },
    "percentiles1": {
        "total": "38",
        "ok": "9068",
        "ko": "0"
    },
    "percentiles2": {
        "total": "9047",
        "ok": "20065",
        "ko": "0"
    },
    "percentiles3": {
        "total": "29721",
        "ok": "36820",
        "ko": "17024"
    },
    "percentiles4": {
        "total": "44989",
        "ok": "51701",
        "ko": "32741"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 1704,
        "percentage": 4
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 337,
        "percentage": 1
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 13391,
        "percentage": 33
    },
    "group4": {
        "name": "failed",
        "count": 24768,
        "percentage": 62
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "154.615",
        "ok": "59.354",
        "ko": "95.262"
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
        "ok": "7540",
        "ko": "12560"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "29",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "59501",
        "ok": "59501",
        "ko": "58455"
    },
    "meanResponseTime": {
        "total": "3648",
        "ok": "7163",
        "ko": "1539"
    },
    "standardDeviation": {
        "total": "6276",
        "ok": "7736",
        "ko": "3903"
    },
    "percentiles1": {
        "total": "50",
        "ok": "5566",
        "ko": "0"
    },
    "percentiles2": {
        "total": "5865",
        "ok": "10511",
        "ko": "0"
    },
    "percentiles3": {
        "total": "15913",
        "ok": "21283",
        "ko": "9696"
    },
    "percentiles4": {
        "total": "27753",
        "ok": "36528",
        "ko": "17124"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 1015,
        "percentage": 5
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 259,
        "percentage": 1
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 6266,
        "percentage": 31
    },
    "group4": {
        "name": "failed",
        "count": 12560,
        "percentage": 62
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "77.308",
        "ok": "29",
        "ko": "48.308"
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
        "ok": "7892",
        "ko": "12208"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "43",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "60053",
        "ok": "59939",
        "ko": "60053"
    },
    "meanResponseTime": {
        "total": "8853",
        "ok": "17711",
        "ko": "3126"
    },
    "standardDeviation": {
        "total": "13095",
        "ok": "13975",
        "ko": "8518"
    },
    "percentiles1": {
        "total": "0",
        "ok": "17862",
        "ko": "0"
    },
    "percentiles2": {
        "total": "17691",
        "ok": "27038",
        "ko": "0"
    },
    "percentiles3": {
        "total": "35326",
        "ok": "42579",
        "ko": "23336"
    },
    "percentiles4": {
        "total": "50674",
        "ok": "55205",
        "ko": "38671"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 689,
        "percentage": 3
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 78,
        "percentage": 0
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 7125,
        "percentage": 35
    },
    "group4": {
        "name": "failed",
        "count": 12208,
        "percentage": 61
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "77.308",
        "ok": "30.354",
        "ko": "46.954"
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
