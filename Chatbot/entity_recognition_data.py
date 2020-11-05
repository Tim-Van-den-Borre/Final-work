def preprocessdata():
    TRAIN_DATA = [
        ("I would like an appointment with doctor Tim", {"entities": [(40, 43, "name_doctor")]}),

        ("I would like an appointment with doctor Ayse", {"entities": [(40, 44, "name_doctor")]}),

        ("I would like an appointment with doctor Alexander", {"entities": [(40, 49, "name_doctor")]}),

        ("I would like an appointment with doctor Michael", {"entities": [(40, 47, "name_doctor")]}),

        ("I would like an appointment at 9am", {"entities": [(32, 34, "appointment_hour")]}),

        ("Is an appointment at 10am possible?", {"entities": [(22, 25, "appointment_hour")]}),

        ("Is an appointment at 10pm possible?", {"entities": [(22, 25, "appointment_hour")]}),

        ("I would like an appointment at 9pm", {"entities": [(32, 34, "appointment_hour")]}),

        ("Is an appointment at 9am possible or not? ", {"entities": [(22, 24, "appointment_hour")]}),

        ("i would like an appointment at 9pm", {"entities": [(32, 34, "appointment_hour")]}),
    ]
    return TRAIN_DATA