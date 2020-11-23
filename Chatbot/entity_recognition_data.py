def preprocessdata():
    TRAIN_DATA = [

        # Name doctor
        ("I would like an appointment with doctor Tim", {"entities": [(40, 43, "name_doctor")]}),

        ("I would like an appointment with doctor Ayse", {"entities": [(40, 44, "name_doctor")]}),

        ("I would like an appointment with doctor Alexander", {"entities": [(40, 49, "name_doctor")]}),

        ("I would like an appointment with doctor Michael", {"entities": [(40, 47, "name_doctor")]}),

        ("An appointment with doctor Kevin please.", {"entities": [(27, 32, "name_doctor")]}),

        ("Is doctor Carla free tomorrow?", {"entities": [(10, 15, "name_doctor")]}),


        # Appointment day
        ("Can i have an appointment tomorrow?", {"entities": [(27, 34, "appointment_day")]}),

        ("Can i have an appointment today?", {"entities": [(27, 31, "appointment_day")]}),

        ("Is an appointment for today still possible?", {"entities": [(27, 34, "appointment_day")]}),

        ("Can i have an appointment next thursday?", {"entities": [(27, 34, "appointment_day")]}),


        # Name doctor & Appointment day
        ("Can i have an appointment with doctor tim tomorrow?", {"entities": [(38, 41, "name_doctor"), (43, 50, "appointment_day")]}),

        ("Can i have an appointment with doctor tim next monday?", {"entities": [(38, 41, "name_doctor"), (43, 54, "appointment_day")]}),


        # Appointment hour
        ("I would like an appointment at 9am", {"entities": [(32, 34, "appointment_hour")]}),

        ("Is an appointment at 10am possible?", {"entities": [(22, 25, "appointment_hour")]}),

        ("Is an appointment at 10pm possible?", {"entities": [(22, 25, "appointment_hour")]}),

        ("I would like an appointment at 9pm", {"entities": [(32, 34, "appointment_hour")]}),

        ("Is an appointment at 9am possible or not?", {"entities": [(22, 24, "appointment_hour")]}),

        ("I would like an appointment at 9pm", {"entities": [(32, 34, "appointment_hour")]}),

        ("Is an appointment at 9am a possibility?", {"entities": [(22, 24, "appointment_hour")]}),

        ("Is an appointment at 9am and 10am a possibility?", {"entities": [(22, 24, "appointment_hour"), (30, 34, "appointment_hour")]})
    ]
    return TRAIN_DATA